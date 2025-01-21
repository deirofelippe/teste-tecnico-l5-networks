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
    `id` INT PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 

INSERT INTO `Film` (`id`, `name`) VALUES
(1, 'A New Hope'),
(2, 'The Empire Strikes Back'),
(3, 'Return of the Jedi'),
(4, 'The Phantom Menace'),
(6, 'Revenge of the Sith'),
(7, 'The Force Awakens');

CREATE TABLE IF NOT EXISTS Author (
    `id` INT PRIMARY KEY NOT NULL, 
    `name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 

INSERT INTO `Author` (`id`, `name`) VALUES
(1737501933, 'Teste'),
(1737501949, 'Felippe'),
(1737502025, 'Teste 2'),
(1737502169, 'Oliveira');

CREATE TABLE IF NOT EXISTS Comment (
    `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    `film_id` INT NOT NULL, 
    `author_id` INT NOT NULL, 
    `comment` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL, 
    `created_at` DATETIME NOT NULL,
    FOREIGN KEY (`film_id`) REFERENCES Film(`id`),
    FOREIGN KEY (`author_id`) REFERENCES Author(`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci; 

INSERT INTO `Comment` (`id`, `film_id`, `author_id`, `comment`, `created_at`) VALUES
(1, 1, 1737501933, 'Comentário teste.', '2025-01-21 20:25:33'),
(2, 1, 1737501949, 'Filme muito bom.', '2025-01-21 20:25:49'),
(3, 1, 1737502025, 'Teste 2', '2025-01-21 20:27:05'),
(4, 6, 1737501949, 'Melhor filme.', '2025-01-21 20:27:27'),
(5, 7, 1737501949, 'Maneirinho.', '2025-01-21 20:27:44'),
(6, 4, 1737501949, 'JarJar não da :(', '2025-01-21 20:28:51'),
(7, 4, 1737502169, 'Darth Maul é muito brabo.', '2025-01-21 20:29:29'),
(8, 2, 1737501949, 'Segundo melhor filme.', '2025-01-21 20:29:55'),
(9, 2, 1737502169, 'Filme maneiro.', '2025-01-21 20:30:11'),
(10, 3, 1737502169, 'O melhor.', '2025-01-21 20:30:27');