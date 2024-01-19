import tweepy
from dotenv import dotenv_values

config = dotenv_values(".env")

auth = tweepy.OAuth2BearerHandler(config.get("TWITTER_ACCESS_TOKEN"))
api = tweepy.API(auth)

KEYWORDS = config.get("TWITTER_SEARCH_KEYWORD")

# Basic keyword search
tweets = api.search_tweets(KEYWORDS, result_type="recent", tweet_mode="extended")

with open("tweets.json", "w") as file:
    file.write(tweets)
