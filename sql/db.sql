CREATE DATABASE yeticaveKvSh
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_0900_ai_ci;

  USE yeticaveKvSh;

CREATE TABLE categories (
  id    INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title  VARCHAR(150) NOT NULL UNIQUE,
  symbol_code VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE users (
   id    INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   reg_date  DATETIME NOT NULL,
   email VARCHAR(100) NOT NULL UNIQUE,
   user_name VARCHAR(50) NOT NULL,
   password  VARCHAR(255) NOT NULL,
   contact VARCHAR(15) NOT NULL UNIQUE
);


CREATE TABLE lots (
  id    INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date_of_creation  DATETIME NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  image_url VARCHAR(150) NOT NULL,
  start_price DECIMAL NOT NULL,
  end_date  DATE NOT NULL,
  bet_step  INT NOT NULL,
  author_id INT NOT NULL,
  winner_id INT,
  category_id INT NOT NULL,
  FOREIGN KEY (author_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES  categories(id)
);

CREATE TABLE bets (
  id    INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date_bet  DATETIME NOT NULL,
  bet_amount  DECIMAL NOT NULL,
  user_id INT NOT NULL,
  lot_id  INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);

