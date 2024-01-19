
# WEB APP

## Installation

Clone project

```bash
  git clone git@github.com:DedyHrmawan/ikn.git
```

Run sql command on `database/init_database.sql` to create several tables
```sql
CREATE TABLE IF NOT EXISTS tweets (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	tweet TEXT NOT NULL,
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

CREATE TABLE IF NOT EXISTS datasets (
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	sentiment TEXT NOT NULL,
	class VARCHAR(50) NOT NULL,
	expected_result TINYINT UNSIGNED,
	prediction_result TINYINT UNSIGNED,
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

CREATE TABLE IF NOT EXISTS results (
	id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	class VARCHAR(50) NOT NULL,
	precision_value DECIMAL(5, 2) NOT NULL,
	accuracy_value DECIMAL(5, 2) NOT NULL,
	recall_value DECIMAL(5, 2) NOT NULL,
	f_measure_value DECIMAL(5, 2) NOT NULL,
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

ALTER TABLE
	datasets
ADD
	COLUMN preprocessed TEXT;

ALTER TABLE
	results
MODIFY
	COLUMN precision_value DECIMAL(5, 4) NOT NULL,
MODIFY
	COLUMN accuracy_value DECIMAL(5, 4) NOT NULL,
MODIFY
	COLUMN recall_value DECIMAL(5, 4) NOT NULL,
MODIFY
	COLUMN f_measure_value DECIMAL(5, 4) NOT NULL

```

### If you want to use docker instead of setup manually, you can run this command

```bash
  docker compose up -d
```

Visit http://127.0.0.1:8000

### Or if you want to setup manually, you can follow this steps

Open folder web

```bash
  cd web
```

Update application/config/database.php configuration

```php
  ...

  $db['default'] = array(
	'dsn'	=> '',
	'hostname' => '',
	'username' => '',
	'password' => '',
	'database' => '',
  ...
```

Update application/config/config.php configuration

```php
  $config['base_url'] = '';
```

And also run the sql command on step above
