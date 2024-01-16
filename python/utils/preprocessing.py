import re
import string

import pandas as pd
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory


def _remove_tweet_special(text: str) -> str:
    # remove tab, new line, ans back slice
    text = (
        text.replace("\\t", " ")
        .replace("\\n", " ")
        .replace("\\u", " ")
        .replace("\\", "")
    )
    # remove non ASCII (emoticon, chinese word, .etc)
    text = text.encode("ascii", "replace").decode("ascii")
    # remove mention, link, hashtag
    text = " ".join(re.sub(r"([@#][A-Za-z0-9]+)|(\w+:\/\/\S+)", " ", text).split())
    # remove incomplete URL
    return text.replace("http://", " ").replace("https://", " ")


def _remove_number(text: str) -> str:
    return re.sub(r"\d+", "", text)


def _remove_punctuation(text: str) -> str:
    return text.translate(str.maketrans("", "", string.punctuation))


def _remove_whitespace_LT(text: str) -> str:
    return text.strip()


def _remove_whitespace_multiple(text: str) -> str:
    return re.sub(r"\s+", " ", text)


def _remove_single_char(text: str) -> str:
    return re.sub(r"\b[a-zA-Z]\b", "", text)


def _tokenization(data: pd.Series) -> pd.Series:
    return (
        data.apply(_remove_tweet_special)
        .apply(_remove_number)
        .apply(_remove_punctuation)
        .apply(_remove_whitespace_LT)
        .apply(_remove_whitespace_multiple)
        .apply(_remove_single_char)
        .apply(lambda x: word_tokenize(x))
    )


def _filtering(data: pd.Series) -> pd.Series:
    list_stopwords = set(stopwords.words("indonesian"))

    return data.apply(
        lambda text: [word for word in text if not word in list_stopwords]
    )


def _stemmer(data: pd.Series) -> pd.Series:
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()

    return data.apply(lambda x: " ".join([stemmer.stem(word) for word in x]))


def preprocessing_data(data: pd.DataFrame) -> pd.DataFrame:
    # Case Folding
    data["opinion"] = data["opinion"].str.lower()
    # Tokenization
    data["opinion"] = _tokenization(data["opinion"])
    # Filtering
    data["opinion"] = _filtering(data["opinion"])
    # Steaming
    data["opinion"] = _stemmer(data["opinion"])

    return data
