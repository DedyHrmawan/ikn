import pickle
import sys
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

    with cnx.cursor() as cursor:
        cursor.execute(
            "SELECT sentiment, expected_result as label FROM datasets WHERE class = %s AND expected_result IS NOT NULL",
            ["Training"],
        )
        training_datasets = cursor.fetchall()
        if training_datasets is None or len(training_datasets) == 0:
            cnx.close()  # Close the connection
            sys.exit("No training dataset found")

    datasets = pd.DataFrame(training_datasets, columns=["opinion", "label"])

    preprocessing.preprocessing_data(datasets)

    datasets = pd.read_csv("preprocessed_training_datasets.csv")

    x_train, x_test, y_train, y_test = train_test_split(
        datasets["opinion"], datasets["label"], test_size=0.2, random_state=42
    )

    count_vec = CountVectorizer()
    x_train_count = count_vec.fit_transform(x_train)
    x_test_count = count_vec.transform(x_test)

    tfidf_transformer = TfidfTransformer()
    x_train_tfidf = tfidf_transformer.fit_transform(x_train_count)
    x_test_tfidf = tfidf_transformer.transform(x_test_count)

    nb_model = MultinomialNB()
    nb_model.fit(x_train_tfidf, y_train)

    with open("naive_bayes_model.pkl", "wb") as file:
        pickle.dump(nb_model, file)

    y_pred = nb_model.predict(x_test_tfidf)

    cr = classification_report(y_test, y_pred)
    print(cr)

    # Get precision, recall, fscore, and support for each class
    precision, recall, fscore, support = precision_recall_fscore_support(y_test, y_pred)

    labels = ["Negative", "Netral", "Positive"]
    # Specify the label for which you want to calculate accuracy
    for specified_label in range(len(labels)):
        # Find the index of the specified label in the classes
        label_index = list(nb_model.classes_).index(specified_label)

        # Calculate accuracy for the specified label
        accuracy = accuracy_score(
            y_test[y_test == specified_label], y_pred[y_test == specified_label]
        )

        with cnx.cursor() as cursor:
            sql = "SELECT * FROM results WHERE class = %s"
            params = [labels[specified_label]]
            cursor.execute(sql, params)

            timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            # checking if result with specified class is existing or not
            if cursor.fetchone() is not None:
                upsert_sql = "UPDATE results SET precision_value = %s, accuracy_value = %s, recall_value = %s, f_measure_value = %s, updated_at = %s WHERE class = %s"
                upsert_params = [
                    precision[label_index],  # type: ignore
                    accuracy,
                    recall[label_index],  # type: ignore
                    fscore[label_index],  # type: ignore
                    labels[specified_label],
                    timestamp,
                ]
            else:
                upsert_sql = "INSERT INTO results (class, precision_value, accuracy_value, recall_value, f_measure_value, created_at, updated_at) VALUES (%s, %s, %s, %s, %s, %s, %s)"
                upsert_params = [
                    labels[specified_label],
                    precision[label_index],  # type: ignore
                    accuracy,
                    recall[label_index],  # type: ignore
                    fscore[label_index],  # type: ignore
                    timestamp,
                    timestamp,
                ]

            cursor.execute(upsert_sql, upsert_params)
            cnx.commit()

    cnx.close()  # Close the connection


if __name__ == "__main__":
    main()