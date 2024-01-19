import tweepy

auth = tweepy.OAuth2BearerHandler(
    "AAAAAAAAAAAAAAAAAAAAADbyrwEAAAAAUGr5fuaWzxa5Xb9s1U2NmxoevIw%3DkuEcLtGPSsdQh8Iaw8p7VdCirN2iuUFds2Cy2OROOu0WlsN6hL"
)
api = tweepy.API(auth)

KEYWORDS = '"ibu kota negara" (ikn OR ibu kota negara)'

# Basic keyword search
tweets = api.search_tweets(KEYWORDS, result_type="recent", tweet_mode="extended")

with open("tweets.json", "w") as file:
    file.write(tweets)
