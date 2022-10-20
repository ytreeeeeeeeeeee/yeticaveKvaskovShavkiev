INSERT INTO categories(title, symbol_code) VALUES ("Доски и лыжи", "boards"),
                                                  ("Крепления", "attachment"),
                                                  ("Ботинки", "boots"),
                                                  ("Одежда", "clothing"),
                                                  ("Инструменты", "tools"),
                                                  ("Разное", "others");

INSERT INTO users(reg_date, email, user_name, password, contact) VALUES ("2022-05-12 12:00:00", "agsfd@mail.ru", "gribo4ek", "12345678", "89455456778"),
                                                                        ("2022-08-24 12:00:00", "hd@mail.ru", "grib", "12345678", "89435937809"),
                                                                        ("2021-12-15 00:00:00", "yabloko@mail.ru", "lakalut", "oral_cumshot", "89779703724"),
                                                                        ("2020-01-09 13:00:16", "oplako@yandex.ru", "oblacko", "leomax123", "98779863883"),
                                                                        ("2022-06-07 17:15:12", "opar@gmail.com", "pilula", "azizovenemy", "89153764526"),
                                                                        ("2021-07-15 18:24:15", "nikol@mail.ru", "clilipcichik", "oparish", "79152472334");

INSERT INTO lots(date_of_creation, title, description, image_url, start_price, end_date, bet_step, author_id, winner_id, category_id)
VALUES ("2022-10-06 15:00:00", "2014 Rossignol District Snowboard", "JDSVSHJGDHV", "img/lot-1.jpg", 10999, "2022-10-14 12:00:00", 100, 6, NULL, 1),
       ("2022-10-07 15:00:00", "DC Ply Mens 2016/2017 Snowboard", "sd", "img/lot-2.jpg", 15999, "2022-10-11 15:00:00", 100, 1, 6, 2),
       ("2022-10-08 15:00:00", "Крепления Union Contact Pro 2015 года размер L/XL", "DSDF", "img/lot-3.jpg", 8000, "2022-10-23 15:00:00", 100, 5, NULL, 2),
       ("2022-10-08 13:00:01", "Ботинки для сноуборда DC Mutiny Charocal", "Pogf", "img/lot-4.jpg", "10999", "2022-10-09 13:00:00", 100, 4, NULL, 1),
       ("2022-10-05 18:00:00", "Куртка для сноуборда DC Mutiny Charocal", "dsfdf", "img/lot-5.jpg", "7500", "2022-10-09 15:00:00", 200, 1, 3, 2),
       ("2022-10-06", "Маска Oakley Canopy", "fdf", "img/lot-6.jpg", "5400", "2022-10-09 17:00:00", 100, 6, 2, 1),
       ("2022-10-08 15:00:00","Крепления Union Contact Pro 2015 года размер L/XL","Крепления", "img/lot-3.jpg", 8000, "2023-10-23 15:00:00", 100, 5, NULL, 2),
       ("2022-10-06 15:00:00", "2014 Rossignol District Snowboard", "Snowboard", "img/lot-1.jpg", 10999, "2022-10-16 12:00:00", 100, 6, NULL, 1),
       ("2022-10-07 15:00:00", "DC Ply Mens 2016/2017 Snowboard", "Snowboard", "img/lot-2.jpg", 15999, "2022-10-11 15:00:00", 100, 1, 6, 2);

INSERT INTO bets(date_bet, bet_amount, user_id, lot_id) VALUES ("2022-10-08 15:22:32", 12000, 5, 2),
                                                               ("2022-10-08 15:25:32", 13000, 2, 2),
                                                               ("2022-10-06 15:13:00", 11000, 3, 1),
                                                               ("2022-10-08 13:00:00", 14000, 4, 2),
                                                               ("2022-10-07 17:00:00", 6000, 1, 6),
                                                               ("2022-10-09 16:00:00", 8000, 4, 5),
                                                               ("2022-10-08 17:00:00", 9000, 1, 3),
                                                               ("2022-10-06 20:00:00", 7700, 3, 2);

SELECT * FROM categories

SELECT l.title, l.start_price, l.image_url, c.title
FROM lots l
JOIN categories c ON l.category_id = c.id
ORDER BY l.date_of_creation DESC
LIMIT 5;

SELECT l.*, c.title
FROM lots l JOIN categories c ON c.id = l.category_id
WHERE l.id = 3;

UPDATE lots
SET title = "hjfdgvhdfgvjhd"
WHERE id = 1;

SELECT * FROM bets
WHERE lot_id = 2
ORDER BY date_bet DESC;

CREATE FULLTEXT INDEX search_lot ON lots(title, description);
