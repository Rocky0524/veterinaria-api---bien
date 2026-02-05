CREATE DATABASE IF NOT EXISTS veterinaria_db;
USE veterinaria_db;

-- 1. Crear la tabla de Dueños primero
CREATE TABLE duenos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 2. Crear la tabla de Animales vinculada
CREATE TABLE animales (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    dueno_id BIGINT UNSIGNED NOT NULL,           
    nombre VARCHAR(255) NOT NULL,                 
    tipo ENUM('perro', 'gato', 'hámster', 'conejo') NOT NULL, 
    peso DECIMAL(8,2) NOT NULL,                   
    enfermedad VARCHAR(255) DEFAULT NULL,          
    comentarios TEXT DEFAULT NULL,                 
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    CONSTRAINT fk_dueno FOREIGN KEY (dueno_id) REFERENCES duenos(id) ON DELETE CASCADE
);

-- Insertar un dueño
INSERT INTO duenos (nombre, apellido) VALUES ('Juan', 'García');

-- Insertar un animal para ese dueño (Juan tiene el ID 1)
INSERT INTO animales (dueno_id, nombre, tipo, peso, enfermedad, comentarios) 
VALUES (1, 'Firulais', 'perro', 10.50, 'Gripe canina', 'Es un perro muy tranquilo');