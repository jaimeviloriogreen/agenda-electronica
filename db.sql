CREATE DATABASE agenda;

CREATE TABLE
    evento(
        id INT PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(250) NOT NULL,
        hoy DATE NOT NULL,
        evento DATE NOT NULL 
    );