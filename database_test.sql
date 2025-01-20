CREATE DATABASE IF NOT EXISTS testel5_test CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

USE testel5_test;

CREATE TABLE IF NOT EXISTS Log (
    `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    `datetime` DATETIME NOT NULL, 
    `level` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL, 
    `context` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL, 
    `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 

CREATE TABLE IF NOT EXISTS Film (
    `id` INT PRIMARY KEY NOT NULL 
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 

CREATE TABLE IF NOT EXISTS Author (
    `id` INT PRIMARY KEY NOT NULL, 
    `name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 

CREATE TABLE IF NOT EXISTS Comment (
    `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    `film_id` INT NOT NULL, 
    `author_id` INT NOT NULL, 
    `comment` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL, 
    `created_at` DATETIME NOT NULL,
    FOREIGN KEY (`film_id`) REFERENCES Film(`id`),
    FOREIGN KEY (`author_id`) REFERENCES Author(`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 