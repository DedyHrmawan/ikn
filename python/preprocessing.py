from dotenv import dotenv_values
from utils import database

config = dotenv_values(".env")

databaseConfig = {
    "host": config["DB_HOST"],
    "port": config["DB_PORT"],
    "user": config["DB_USER"],
    "password": config["DB_PASSWORD"],
    "database": config["DB_DATABASE"],
}

cnx = database.connect(databaseConfig, attempts=3)

with cnx.cursor() as cursor:
    result = cursor.execute(
        "SELECT sentiment, expected_result as label FROM datasets WHERE class = %s AND expected_result IS NOT NULL",
        ["Training"],
    )
    trainingDatasets = cursor.fetchall()

print(trainingDatasets)
cnx.close()
