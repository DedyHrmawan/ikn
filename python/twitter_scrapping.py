import subprocess
from datetime import datetime

import pandas
from dotenv import dotenv_values
from utils import database

config = dotenv_values(".env")

TW_API_TOKEN = config.get("TWITTER_API_TOKEN")
TW_SEARCH_KEYWORD = config.get("TWITTER_SEARCH_KEYWORD")
TW_RESULT_FILENAME = "scraped_tweets.csv"

CONFIG_DATABASE = {
    "host": config["DB_HOST"],
    "port": config["DB_PORT"],
    "user": config["DB_USER"],
    "password": config["DB_PASSWORD"],
    "database": config["DB_DATABASE"],
}


def main():
    subprocess.run(
        f'npx tweet-harvest -o "{TW_RESULT_FILENAME}" -s "{TW_SEARCH_KEYWORD}" -t LATEST -l 100 --token {TW_API_TOKEN}',
        shell=True,
    )

    with open(f"tweets-data/{TW_RESULT_FILENAME}", "r") as file:
        dataset = pandas.read_csv(file)

    cnx = database.connect(CONFIG_DATABASE, attempts=3)

    if cnx is None:
        raise Exception("Could not connect to database")

    for tweetIdx in range(len(dataset)):
        with cnx.cursor() as cursor:
            timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            sql = (
                "INSERT INTO tweets (tweet, created_at, updated_at) VALUES (%s, %s, %s)"
            )
            params = [dataset["full_text"][tweetIdx], timestamp, timestamp]

            cursor.execute(sql, params)
            cnx.commit()

    cnx.close()


if __name__ == "__main__":
    main()
