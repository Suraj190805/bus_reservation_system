CREATE DATABASE IF NOT EXISTS indiabus CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE indiabus;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ticket_number VARCHAR(64) NOT NULL UNIQUE,
  user_id INT NOT NULL,
  service_id VARCHAR(64),
  service_name VARCHAR(255),
  bus_number VARCHAR(64),
  seats TEXT,
  travel_date DATE NULL,
  amount DECIMAL(10,2),
  paid_by VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
