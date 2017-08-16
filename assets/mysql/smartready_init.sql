-- Esto es un comentario

-- Primero tratamos de borrar la base, en caso de que exista

DROP DATABASE IF EXISTS smartready;

CREATE DATABASE smartready;



USE smartready;

CREATE TABLE user (
    id                  INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name                VARCHAR(100) NULL,
    lastname            VARCHAR(100) NULL,
    email               VARCHAR(200) NOT NULL,
    password            VARCHAR(128) NOT NULL,
    remember            TINYINT UNSIGNED DEFAULT 0 NOT NULL,
    cookie_rnd          TINYINT UNSIGNED DEFAULT 0 NOT NULL,
    extImagen           CHAR(4) NULL
);
