# Classification Using Naive Bayes

## Installation

Clone project

```bash
  git clone git@github.com:DedyHrmawan/ikn.git
```

Open folder pyhton

```bash
  cd pyhton
```

Copy .env file

```bash
  cp .env.example .env
```

Update database configuration

```bash
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=
  DB_USER=
  DB_PASSWORD=
```

Install python packages

```bash
  pip install -r requirement.txt
```

Install node js packages

```bash
  npm install
```

Get Twitter [Auth Token from cookies](twitter_api_token.png) and update the TWITTER_API_TOKEN config

```bash
  ...
  TWITTER_API_TOKEN=
  ...
```

## Usage

When you want to use the training dataset as testing data to get the confusion matrix of the created model, use this config

```bash
  USE_TRAINING_DATA_FOR_TESTING=True # Assign True when you want to use data training for testing confusion matrix
```

When you want to change percentage testing data of the created model, use this config

```bash
  SPLIT_TESTING_SIZE_RATIO=0.25
```

When you want to change filename of exported model, etc, change this config

```bash
  NB_MODEL_FILENAME=naive_bayes_model.pkl

  COUNT_VECTORIZER_FILENAME=train_count_vec.pkl

  TFIDF_TRANSFORMER_FILENAME=train_tfidf_transformer.pkl
```
