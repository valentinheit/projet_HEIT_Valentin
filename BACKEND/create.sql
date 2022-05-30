DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Product;

CREATE TABLE Client(
    id SERIAL PRIMARY KEY,
    last_name VARCHAR(48),
    first_name VARCHAR(48),
    login VARCHAR(48) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(256)
);

CREATE TABLE Product(
    id SERIAL PRIMARY KEY,
    name VARCHAR(32),
    brand VARCHAR(32),
    cores INTEGER,
    threads INTEGER,
    price INTEGER
);

INSERT INTO Product(name, brand, cores, threads, price)
VALUES ('i5-12600k', 'Intel', 10, 16, 348),
       ('i5-11600k', 'Intel', 6, 12, 265),
       ('i9-12900k', 'Intel', 16, 24, 694),
       ('i7-12700k', 'Intel', 12, 20, 492),
       ('i9-11900k', 'Intel', 8, 16, 620),
       ('r9 5900x', 'AMD', 12, 24, 646),
       ('r9 5950x', 'AMD', 16, 32, 780),
       ('r7 5800x', 'AMD', 8, 16, 369),
       ('r5 5600x', 'AMD', 6, 12, 323),
       ('r9 3900x', 'AMD', 12, 24, 455);
