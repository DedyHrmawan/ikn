import pickle
import sys
import time
from datetime import datetime

import pandas as pd
from dotenv import dotenv_values
from sklearn.feature_extraction.text import CountVectorizer, TfidfTransformer
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
            "SELECT id, sentiment FROM datasets WHERE class = %s", ["Testing"]
        )

        testing_datasets = cursor.fetchall()
        if testing_datasets is None or len(testing_datasets) == 0:
            cnx.close()
            sys.exit(1)

    datasets = pd.DataFrame(testing_datasets, columns=["id", "opinion"])

    preprocessing.preprocessing_data(datasets)

    prediction_sentiment = time.time() - start_time
    start_time = time.time()
    print(f"Preprocessing {len(datasets.index)} data took {prediction_sentiment}s")

    with open("train_count_vectorizer.pkl", "rb") as file:
        count_vec: CountVectorizer = pickle.load(file)
    x_test_count = count_vec.transform(datasets["opinion"])

    with open("train_tfidf_transformer.pkl", "rb") as file:
        tfidf_transformer: TfidfTransformer = pickle.load(file)
    x_test_tfidf = tfidf_transformer.transform(x_test_count)

    with open("naive_bayes_model.pkl", "rb") as file:
        nb_model: MultinomialNB = pickle.load(file)

    y_pred = nb_model.predict(x_test_tfidf)

    prediction_sentiment = time.time() - start_time
    start_time = time.time()
    print(
        f"Prediction model of {len(datasets.index)} data took {prediction_sentiment}s"
    )

    store_preprocessing_result(cnx, datasets, y_pred)

    save_preprocessed_and_predicted_sentiment = time.time() - start_time
    print(
        f"Save preprocessed and prediction {len(datasets.index)} sentiment data took {save_preprocessed_and_predicted_sentiment}s"
    )

    cnx.close()


def store_preprocessing_result(cnx, datasets, y_pred):
    # Save preprocessed opinion into databases
    for i in datasets.index:
        with cnx.cursor() as cursor:
            timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            sql = "UPDATE datasets SET preprocessed=%s, prediction_result=%s, updated_at=%s WHERE id = %s"
            params = [
                str(datasets["opinion"][i]),
                int(y_pred[i]),
                timestamp,
                int(datasets["id"][i]),  # type: ignore
            ]

            cursor.execute(sql, params)
            cnx.commit()


if __name__ == "__main__":
    main()
