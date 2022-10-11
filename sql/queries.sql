INSERT INTO categories(title, symbol_code) VALUES ("Доски и лыжи", "boards"),
                                                  ("Крепления", "attachment"),
                                                  ("Ботинки", "boots"),
                                                  ("Одежда", "clothing"),
                                                  ("Инструменты", "tools"),
                                                  ("Разное", "others");

INSERT INTO users(reg_date, email, user_name, password, contact) VALUES ("2022-05-12 12:00:00", "agsfd@mail.ru", "gribo4ek", 12345678, "89455456778"),
                                                                        ("2022-08-24 12:00:00", "hd@mail.ru", "grib", 12345678, "89435937809");

INSERT INTO lots(date_of_creation, title, description, image_url, start_price, end_date, bet_step, author_id, winner_id, category_id)
VALUES ("2022-10-06 15:00:00", "2014 Rossignol District Snowboard", "JDSVSHJGDHV", "img/lot-1.jpg", 10999, "2022-10-14 12:00:00", 100, 1, NULL, 1),
       ("2022-10-07 15:00:00", "DC Ply Mens 2016/2017 Snowboard", "sd", "img/lot-2.jpg", 15999, "2022-10-11 15:00:00", 100, 1, 2, 1),
       ("2022-10-08 15:00:00", "Крепления Union Contact Pro 2015 года размер L/XL", "DSDF", "img/lot-3.jpg", 8000, "2022-10-23 15:00:00", 100, 2, NULL, 2);

INSERT INTO bets(date_bet, bet_amount, user_id, lot_id) VALUES ("2022-10-08 15:22:32", 12000, 2, 2),
                                                               ("2022-10-08 15:25:32", 13000, 2, 2)

SELECT * FROM categories

SELECT l.title, l.start_price, l.image_url, b.bet_amount, c.title
FROM lots l JOIN bets b ON l.id = b.lot_id
JOIN categories c ON l.category_id = c.id
ORDER BY l.id DESC
LIMIT 1;

SELECT l.*, c.title
FROM lots l JOIN categories c ON c.id = l.category_id
WHERE l.id = 3;

UPDATE lots
SET title = "hjfdgvhdfgvjhd"
WHERE id = 1;

SELECT * FROM bets
WHERE lot_id = 2
ORDER BY date_bet DESC;
