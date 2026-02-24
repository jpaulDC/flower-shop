-- Flower Shop E-Commerce Database Schema
-- For use with SQLyog and CodeIgniter 3

-- Create Database
CREATE DATABASE IF NOT EXISTS flower_shop;
USE flower_shop;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Flowers Table
CREATE TABLE flowers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(100) NOT NULL,
    color VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    STATUS ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Wrappers Table
CREATE TABLE wrappers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    STATUS ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Ready-made Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(150) NOT NULL,
    DESCRIPTION TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    featured TINYINT(1) DEFAULT 0,
    STATUS ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    customer_phone VARCHAR(20) NOT NULL,
    delivery_address TEXT NOT NULL,
    delivery_date DATE NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    STATUS ENUM('pending', 'confirmed', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_method VARCHAR(50) DEFAULT 'Cash on Delivery',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_type ENUM('ready-made', 'custom') NOT NULL,
    product_id INT NULL,
    custom_details TEXT NULL COMMENT 'JSON format for custom bouquets',
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

-- Insert Default Admin User
-- Password: admin123 (hashed with MD5 for simplicity - use bcrypt in production)
INSERT INTO users (NAME, email, PASSWORD, ROLE) VALUES 
('Admin User', 'admin@flowershop.com', MD5('admin123'), 'admin');

-- Insert Sample Flowers
INSERT INTO flowers (NAME, color, price) VALUES 
('Rose', 'Red', 50.00),
('Rose', 'Pink', 50.00),
('Rose', 'White', 50.00),
('Tulip', 'Yellow', 45.00),
('Tulip', 'Pink', 45.00),
('Sunflower', 'Yellow', 40.00),
('Lily', 'White', 55.00),
('Lily', 'Pink', 55.00),
('Carnation', 'Red', 35.00),
('Carnation', 'White', 35.00);

-- Insert Sample Wrappers
INSERT INTO wrappers (NAME, price) VALUES 
('Kraft Paper', 30.00),
('Korean Style', 50.00),
('Ribbon Wrap', 40.00),
('Cellophane Classic', 25.00);

-- Insert Sample Ready-made Products
INSERT INTO products (NAME, DESCRIPTION, price, featured) VALUES 
('Classic Red Rose Bouquet', 'A dozen beautiful red roses wrapped in elegant paper', 650.00, 1),
('Spring Mix', 'Colorful mix of tulips and carnations', 550.00, 1),
('Sunshine Delight', 'Bright sunflowers with white lilies', 600.00, 1),
('Pink Paradise', 'Romantic pink roses and lilies', 700.00, 0),
('White Elegance', 'Pure white roses and carnations', 580.00, 0);

-- Create indexes for better performance
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_user_role ON users(ROLE);
CREATE INDEX idx_flowers_status ON flowers(STATUS);
CREATE INDEX idx_wrappers_status ON wrappers(STATUS);
CREATE INDEX idx_products_status ON products(STATUS);
CREATE INDEX idx_products_featured ON products(featured);
CREATE INDEX idx_orders_status ON orders(STATUS);
CREATE INDEX idx_orders_user ON orders(user_id);
CREATE INDEX idx_order_items_order ON order_items(order_id);

admin query
USE flower_shop;

-- Delete existing admin if any
DELETE FROM users WHERE email = 'admin@flowershop.com';

-- Insert fresh admin user
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@flowershop.com', MD5('admin123'), 'admin');

-- Verify it worked
SELECT * FROM users;