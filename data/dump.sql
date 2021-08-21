CREATE DATABASE IF NOT EXISTS demo;

USE demo;

CREATE TABLE IF NOT EXISTS employees
(
    id        int primary key,
    name      varchar(255) not null,
    email     varchar(255) not null,
    salary    int          not null,
    rating_id int          not null
);

CREATE TABLE IF NOT EXISTS ratings
(
    id     int primary key,
    rating int default 1
);

INSERT INTO ratings (id, rating)
VALUES (10, 1),
       (20, 2),
       (30, 3),
       (40, 4),
       (50, 5);

INSERT INTO employees (id, name, email, salary, rating_id)
VALUES (1, 'Leanne Graham', 'sincere@april.biz', 100000, 40),
       (2, 'Ervin Howell', 'shanna@melissa.tv', 150000, 50),
       (3, 'Clementine Bauch', 'nathan@yesenia.net', 750000, 30),
       (4, 'Patricia Lebsack', 'julianne.OConner@kory.org', 125000, 50),
       (5, 'Chelsey Dietrich', 'lucio_Hettinger@annie.ca', 500000, 20),
       (6, 'Mrs. Dennis Schulist', 'karley_Dach@jasper.info', 175000, 10),
       (7, 'Kurtis Weissnat', 'telly.Hoeger@billy.biz', 20000, 50),
       (8, 'Nicholas Runolfsdottir V', 'sherwood@rosamond.me', 150000, 20),
       (9, 'Glenna Reichert', 'chaim_McDermott@dana.io', 2000000, 10),
       (10, 'Clementina DuBuque', 'rey.Padberg@karina.biz', 100500, 40);
