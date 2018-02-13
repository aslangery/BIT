CREATE DATABASE IF NOT EXISTS bit;
USE bit;
CREATE TABLE IF NOT EXISTS users(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(40),
  email VARCHAR(100),
  password TINYTEXT
);
CREATE TABLE IF NOT EXISTS billing(
  user_id INTEGER NOT NULL,
  amount DOUBLE
);
CREATE TABLE IF NOT EXISTS expences(
  user_id INTEGER NOT NULL,
  cost DOUBLE NOT NULL,
  payment_date DATETIME
);
  CREATE TABLE IF NOT EXISTS sessions(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    session_id VARCHAR(64)
  );