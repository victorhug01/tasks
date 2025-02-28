CREATE DATABASE IF NOT EXISTS shoppinglist;

USE shoppinglist;

CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    passwrd VARCHAR(200) NOT NULL,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS list (
    id_list int AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    descriptions VARCHAR(1000) NOT NULL,
    time_shopping TIME NOT NULL,
    date_shopping DATE NOT NULL,
    image_product VARCHAR,
    fk_id_user INT NOT NULL,
    FOREIGN KEY (fk_id_user) REFERENCES users(id_user) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);