CREATE DATABASE eventos;

USE eventos;

CREATE TABLE eventos(

    id INT AUTO_INCREMENT PRIMARY KEY,

    titulo VARCHAR(150),

    data_evento DATE,

    local VARCHAR(120)

);