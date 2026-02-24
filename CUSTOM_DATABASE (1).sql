-- ============================================================
-- FLOWER SHOP E-COMMERCE - CUSTOM DATABASE
-- ============================================================
-- Customer's Specific Inventory:
-- - 24 Specific Flowers (all price: 0)
-- - 4 Wrapper Colors (all price: 0)
-- - Admin: byhappiest123@gmail.com / admin123
-- ============================================================

DROP DATABASE IF EXISTS flower_shop;
CREATE DATABASE flower_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE flower_shop;

-- ============================================================
-- TABLE: users
-- ============================================================
CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    NAME       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) UNIQUE NOT NULL,
    PASSWORD   VARCHAR(255) NOT NULL,
    ROLE       ENUM('admin','customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (ROLE)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: flowers
-- ============================================================
CREATE TABLE flowers (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    NAME           VARCHAR(100) NOT NULL,
    color          VARCHAR(50) NOT NULL,
    price          DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock_quantity INT DEFAULT 100,
    image          VARCHAR(255) NULL,
    STATUS         ENUM('active','inactive') DEFAULT 'active',
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (STATUS),
    INDEX idx_name (NAME)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: wrappers
-- ============================================================
CREATE TABLE wrappers (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    NAME           VARCHAR(100) NOT NULL,
    price          DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock_quantity INT DEFAULT 50,
    image          VARCHAR(255) NULL,
    STATUS         ENUM('active','inactive') DEFAULT 'active',
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (STATUS)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: products
-- ============================================================
CREATE TABLE products (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    NAME           VARCHAR(150) NOT NULL,
    DESCRIPTION    TEXT NULL,
    price          DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock_quantity INT DEFAULT 20,
    image          VARCHAR(255) NULL,
    featured       TINYINT(1) DEFAULT 0,
    STATUS         ENUM('active','inactive') DEFAULT 'active',
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (STATUS),
    INDEX idx_featured (featured)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: orders
-- ============================================================
CREATE TABLE orders (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    user_id          INT NULL,
    customer_name    VARCHAR(100) NOT NULL,
    customer_email   VARCHAR(100) NULL,
    customer_phone   VARCHAR(20) NOT NULL,
    delivery_address TEXT NOT NULL,
    delivery_date    DATE NOT NULL,
    total_price      DECIMAL(10,2) NOT NULL,
    STATUS           ENUM('pending','confirmed','delivered','cancelled') DEFAULT 'pending',
    payment_method   VARCHAR(50) DEFAULT 'Cash on Delivery',
    notes            TEXT NULL,
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_status (STATUS),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: order_items
-- ============================================================
CREATE TABLE order_items (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    order_id       INT NOT NULL,
    product_type   ENUM('ready-made','custom') NOT NULL,
    product_id     INT NULL,
    custom_details TEXT NULL,
    quantity       INT NOT NULL DEFAULT 1,
    price          DECIMAL(10,2) NOT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_order (order_id),
    INDEX idx_product (product_id),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- ADMIN USER
-- Email: byhappiest123@gmail.com
-- Password: admin123
-- ============================================================
INSERT INTO users (NAME, email, PASSWORD, ROLE) VALUES
('Admin', 'byhappiest123@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin');

-- ============================================================
-- YOUR CUSTOM FLOWERS (24 items - all price 0)
-- ============================================================
INSERT INTO flowers (NAME, color, price, stock_quantity) VALUES
('Faux Lavender', 'Purple', 0.00, 100),
('Gerbera Daisy', 'White', 0.00, 100),
('Gerbera Daisy', 'Pink', 0.00, 100),
('Tulip', 'Maroon', 0.00, 100),
('Jasmine', 'Pink Centered White', 0.00, 100),
('Lavender', 'Pink', 0.00, 100),
('Lily', 'Pink', 0.00, 100),
('Rose', 'Pink and White Bicolored', 0.00, 100),
('Lavender', 'Purple', 0.00, 100),
('Lily', 'Purple', 0.00, 100),
('Lily', 'Purple Stripped', 0.00, 100),
('Tulip', 'Purple', 0.00, 100),
('Ribbon Rose', 'Red', 0.00, 100),
('Ribbon Rose', 'Royal Blue', 0.00, 100),
('Ribbon Rose', 'Royal Light Black', 0.00, 100),
('Ribbon Rose', 'Royal Light Green', 0.00, 100),
('Ribbon Rose', 'Royal Pink', 0.00, 100),
('Ribbon Rose', 'Royal Purple', 0.00, 100),
('Ribbon Rose', 'Royal Red', 0.00, 100),
('Ribbon Rose', 'Royal Teal', 0.00, 100),
('Ribbon Rose', 'Royal White Satin', 0.00, 100),
('Ribbon Rose', 'Royal', 0.00, 100),
('Sunflower', 'Yellow', 0.00, 100),
('Triple Leaf Stem', 'Green', 0.00, 100),
('Tulip', 'Blue', 0.00, 100);

-- ============================================================
-- YOUR CUSTOM WRAPPERS (4 colors - all price 0)
-- ============================================================
INSERT INTO wrappers (NAME, price, stock_quantity) VALUES
('Blue Wrapper', 0.00, 50),
('Red Wrapper', 0.00, 50),
('Pink Wrapper', 0.00, 50),
('Light Green Wrapper', 0.00, 50);

-- ============================================================
-- VERIFICATION
-- ============================================================
SELECT '========== DATABASE CREATED ==========' AS '';

SELECT '========== ADMIN USER ==========' AS '';
SELECT id, NAME, email, ROLE FROM users WHERE ROLE = 'admin';

SELECT '========== YOUR FLOWERS (25 items) ==========' AS '';
SELECT id, NAME, color, price, stock_quantity, STATUS FROM flowers ORDER BY id;

SELECT '========== YOUR WRAPPERS (4 colors) ==========' AS '';
SELECT id, NAME, price, stock_quantity, STATUS FROM wrappers ORDER BY id;

SELECT '========== SUMMARY ==========' AS '';
SELECT 
    'Total Flowers' AS Item, 
    COUNT(*) AS COUNT 
FROM flowers
UNION ALL
SELECT 'Total Wrappers', COUNT(*) FROM wrappers
UNION ALL
SELECT 'Total Products', COUNT(*) FROM products
UNION ALL
SELECT 'Total Admin Users', COUNT(*) FROM users WHERE ROLE = 'admin';

-- ============================================================
-- NOTES
-- ============================================================
-- All flowers have price 0.00 - Update prices in admin panel
-- All wrappers have price 0.00 - Update prices in admin panel
-- Stock quantities set to default (100 flowers, 50 wrappers)
-- Admin login: byhappiest123@gmail.com / admin123
-- ============================================================
