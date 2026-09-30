CREATE DATABASE IF NOT EXISTS `sun-son-solar`;

USE `sun-son-solar`;

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NULL,
    birthdate DATE NULL,
    gender VARCHAR(30) NULL,
    email VARCHAR(150) NULL UNIQUE,
    phone_number VARCHAR(30) NULL,
    address TEXT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('customer', 'employee', 'admin') NOT NULL DEFAULT 'customer',
    department VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- KATHERINE SINGARAW ADMIN
INSERT INTO users (
    first_name,
    last_name,
    middle_name,
    birthdate,
    gender,
    email,
    phone_number,
    address,
    username,
    password,
    user_type,
    department
) VALUES (
    'Katherine',
    'Singaraw',
    NULL,
    '1985-06-15',
    'Female',
    'kittykat16@example.com',
    '09123456789',
    'Pasig City',
    'KittyKat16',
    '$2y$10$example_hash',
    'admin',
    NULL
);

-- SOL SOLIS ADMIN
INSERT INTO users (
    first_name,
    last_name,
    middle_name,
    birthdate,
    gender,
    email,
    phone_number,
    address,
    username,
    password,
    user_type,
    department
) VALUES (
    'Sol',
    'Solis',
    NULL,
    '1980-01-01',
    'Male',
    'solsolis@example.com',
    '09123456789',
    'Manila',
    'SolSolis',
    '$2y$10$example_hash',
    'admin',
    NULL
);

-- PRODUCTS TABLE
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(150) NOT NULL UNIQUE
);

-- PRODUCTS
INSERT INTO products (product_name) VALUES
    ('Solar panels'),
    ('Inverters'),
    ('Batteries'),
    ('Racking and mounting'),
    ('Wires');

-- SERVICES TABLE
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(150) NOT NULL UNIQUE,
    description TEXT NULL
);

-- SERVICES
INSERT INTO services (service_name, description) VALUES
    ('Consultation', NULL),
    ('Designing', NULL),
    ('Permitting', NULL),
    ('Installation', NULL),
    ('Maintenance', NULL),
    ('Repair', NULL),
    ('Monitoring', NULL);
