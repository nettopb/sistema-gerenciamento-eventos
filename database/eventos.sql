CREATE DATABASE IF NOT EXISTS eventos
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE eventos;

CREATE TABLE IF NOT EXISTS eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    data_evento DATE NOT NULL,
    local VARCHAR(120) NOT NULL
);