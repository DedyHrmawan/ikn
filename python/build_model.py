import pickle
import sys
import time
from datetime import datetime

import pandas as pd
from dotenv import dotenv_values
from sklearn.feature_extraction.text import CountVectorizer, TfidfTransformer
from sklearn.metrics import (
    accuracy_score,
    classification_report,
    precision_recall_fscore_support,
)
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import MultinomialNB
from utils import database, preprocessing

config = dotenv_values(".env")

databaseConfig = {
    "host": config["DB_HOST"],
    "port": config["DB_PORT"],
    "user": config["DB_USER"],
    "password": config["DB_PASSWORD"],
    "database": config["DB_DATABASE"],
}


def main():
    cnx = database.connect(databaseConfig, attempts=3)

    if cnx is None:
        raise Exception("Could not connect to database")

    start_time = time.time()

    with cnx.cursor() as cursor:
        cursor.execute(
            "SELECT id, sentiment, expected_result as label FROM datasets WHERE class = %s AND expected_result IS NOT NULL",
            ["Training"],
        )
        training_datasets = cursor.fetchall()
        if training_datasets is None or len(training_datasets) == 0:
            cnx.close()  # Close the connection
            sys.exit("1")

    datasets = pd.DataFrame(training_datasets, columns=["id", "opinion", "label"])

    preprocessing.preprocessing_data(datasets)

    save_preprocessed_sentiment = time.time() - start_time
    start_time = time.time()
    print(
        f"Preprocessing {len(datasets.index)} data took {save_preprocessed_sentiment}s"
    )

    x_train, x_test, y_train, y_test = train_test_split(
        datasets["opinion"], datasets["label"], test_size=0.25, random_state=42
    )

    count_vec = CountVectorizer()
    x_train_count = count_vec.fit_transform(x_train)
    x_test_count = count_vec.transform(x_test)

    with open("train_count_vectorizer.pkl", "wb") as file:
        pickle.dump(count_vec, file)

    tfidf_transformer = TfidfTransformer()
    x_train_tfidf = tfidf_transformer.fit_transform(x_train_count)
    x_test_tfidf = tfidf_transformer.transform(x_test_count)

    with open("train_tfidf_transformer.pkl", "wb") as file:
        pickle.dump(tfidf_transformer, file)

    nb_model = MultinomialNB()
    nb_model.fit(x_train_tfidf, y_train)

    y_pred = nb_model.predict(x_test_tfidf)

    save_preprocessed_sentiment = time.time() - start_time
    start_time = time.time()
    print(f"Building and testing model took {save_preprocessed_sentiment}s")

    # Persistent the model into pickle format
    with open("naive_bayes_model.pkl", "wb") as file:
        pickle.dump(nb_model, file)

    cr = classification_report(y_test, y_pred)

    save_model_calc_result(cnx, nb_model, y_test, y_pred)

    save_preprocessed_sentiment = time.time() - start_time
    start_time = time.time()
    print(f"Store model results took {save_preprocessed_sentiment}s")

    save_preprocessing_result(cnx, datasets)

    save_preprocessed_sentiment = time.time() - start_time
    print(
        f"Save preprocessed {len(datasets.index)} sentiment data took {save_preprocessed_sentiment}s"
    )

    cnx.close()


def save_model_calc_result(cnx, nb_model, y_test, y_pred):
    # Get precision, recall, fscore, and support for each class
    precision, recall, fscore, support = precision_recall_fscore_support(y_test, y_pred)

    # Specify the label for which you want to calculate accuracy
    labels = ["Negative", "Netral", "Positive"]

    for label_id in range(len(labels)):
        # Find the index of the specified label in the classes
        label_index = list(nb_model.classes_).index(label_id)

        # Calculate accuracy for the specified label
        accuracy = accuracy_score(
            y_test[y_test == label_id], y_pred[y_test == label_id]
        )

        # Update model accuracy into databases
        with cnx.cursor() as cursor:
            sql = "SELECT * FROM results WHERE class = %s"
            params = [labels[label_id]]
            cursor.execute(sql, params)
            result = cursor.fetchone()

            timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            upsert_sql = ""
            upsert_params = []
            # checking if result with specified class is existing or not
            if result is not None:
                upsert_sql = "UPDATE results SET precision_value = %s, accuracy_value = %s, recall_value = %s, f_measure_value = %s, updated_at = %s WHERE class = %s"
                upsert_params = [
                    float(precision[label_index]),  # type: ignore
                    float(accuracy),
                    float(recall[label_index]),  # type: ignore
                    float(fscore[label_index]),  # type: ignore
                    timestamp,
                    labels[label_id],
                ]
            else:
                upsert_sql = "INSERT INTO results (class, precision_value, accuracy_value, recall_value, f_measure_value, created_at, updated_at) VALUES (%s, %s, %s, %s, %s, %s, %s)"
                upsert_params = [
                    labels[label_id],
                    float(precision[label_index]),  # type: ignore
                    float(accuracy),
                    float(recall[label_index]),  # type: ignore
                    float(fscore[label_index]),  # type: ignore
                    timestamp,
                    timestamp,
                ]

            cursor.execute(upsert_sql, upsert_params)
            cnx.commit()


def save_preprocessing_result(cnx, datasets):
    # Save preprocessed opinion into databases
    for i in datasets.index:
        with cnx.cursor() as cursor:
            timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            sql = "UPDATE datasets SET preprocessed=%s, updated_at=%s WHERE id = %s"
            params = [
                str(datasets["opinion"][i]),
                timestamp,
                int(datasets["id"][i]),  # type: ignore
            ]
            cursor.execute(sql, params)
            cnx.commit()


if __name__ == "__main__":
    main()
