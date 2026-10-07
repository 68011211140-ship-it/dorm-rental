CREATE DATABASE IF NOT EXISTS dorm_rental CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dorm_rental;

CREATE TABLE users (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('user','admin') NOT NULL DEFAULT 'user',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE rooms (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 user_id INT UNSIGNED NOT NULL,
 title VARCHAR(150) NOT NULL,
 description TEXT NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 location VARCHAR(255) NOT NULL,
 phone VARCHAR(30) NOT NULL,
 status ENUM('active','hidden') NOT NULL DEFAULT 'active',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 CONSTRAINT fk_rooms_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 INDEX idx_rooms_user (user_id),
 INDEX idx_rooms_status (status)
) ENGINE=InnoDB;

-- หลังสมัครสมาชิก ให้เปลี่ยน role ของบัญชีที่จะเป็น Admin ด้วยคำสั่ง:
-- UPDATE users SET role='admin' WHERE email='admin@example.com';
