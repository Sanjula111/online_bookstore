-- ============================================================
-- Online Bookstore — Complete Database Schema
-- Database : book_store
-- Engine   : InnoDB | Charset : utf8mb4
-- Generated: 2026-05-10
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- ============================================================
-- Create & select the database
-- ============================================================
CREATE DATABASE IF NOT EXISTS `book_store`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `book_store`;

-- ============================================================
-- TABLE: admins
-- Stores administrator accounts for the back-end panel.
-- ============================================================
CREATE TABLE `admins` (
  `admin_id`      INT(10)       NOT NULL AUTO_INCREMENT,
  `admin_name`    VARCHAR(255)  NOT NULL,
  `admin_email`   VARCHAR(255)  NOT NULL UNIQUE,
  `admin_pass`    VARCHAR(255)  NOT NULL COMMENT 'Store hashed password (e.g. bcrypt)',
  `admin_image`   TEXT          NOT NULL DEFAULT 'person.jpg',
  `admin_country` VARCHAR(100)  NOT NULL,
  `admin_about`   TEXT          NOT NULL,
  `admin_contact` VARCHAR(20)   NOT NULL,
  `created_at`    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample admin data
INSERT INTO `admins`
  (`admin_name`, `admin_email`, `admin_pass`, `admin_image`, `admin_country`, `admin_about`, `admin_contact`)
VALUES
  ('Dinuka',  'dinuka@gmail.com',  'dinukaadmin', 'person.jpg', 'Sri Lanka', 'My name is Dinuka',  '0123456789'),
  ('Manager', 'manager@gmail.com', 'manager123',  'person.jpg', 'Sri Lanka', 'Store Manager',      '0987654321');

-- ============================================================
-- TABLE: product_categories
-- Stores artwork / book categories shown in navigation & shop.
-- ============================================================
CREATE TABLE `product_categories` (
  `p_cat_id`    INT(10)  NOT NULL AUTO_INCREMENT,
  `p_cat_title` VARCHAR(255) NOT NULL,
  `p_cat_desc`  TEXT     NOT NULL,
  PRIMARY KEY (`p_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample categories (as present in the project)
INSERT INTO `product_categories` (`p_cat_title`, `p_cat_desc`) VALUES
('Pencil',
  'Pencil drawings are artworks created using graphite pencils, known for their versatility and precision. These drawings can range from detailed, realistic representations to simple, expressive sketches.'),
('Water',
  'These paints are typically applied to paper or other absorbent surfaces, where they produce a translucent, fluid effect creating delicate washes and subtle gradients.'),
('Canvas',
  'Canvas drawings are artworks created on canvas, typically using pencils, charcoal, or ink. The textured surface of the canvas provides a unique foundation that adds depth and character.'),
('Digital',
  'Digital drawings are artworks created using digital tools, such as drawing tablets, styluses, and software like Photoshop, Procreate, or Illustrator.');

-- ============================================================
-- TABLE: products
-- Stores all products (books / artworks) listed in the store.
-- ============================================================
CREATE TABLE `products` (
  `product_id`       INT(10)       NOT NULL AUTO_INCREMENT,
  `p_cat_id`         INT(10)       NOT NULL COMMENT 'FK → product_categories',
  `product_title`    VARCHAR(255)  NOT NULL,
  `product_img`      TEXT          NOT NULL,
  `product_owner`    VARCHAR(255)  NOT NULL COMMENT 'Author / artist name',
  `product_price`    DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `product_keywords` TEXT          NOT NULL,
  `product_des`      TEXT          NOT NULL,
  `date`             TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_category` (`p_cat_id`),
  CONSTRAINT `fk_product_category`
    FOREIGN KEY (`p_cat_id`) REFERENCES `product_categories` (`p_cat_id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample products
INSERT INTO `products` (`p_cat_id`, `product_title`, `product_img`, `product_owner`, `product_price`, `product_keywords`, `product_des`) VALUES
(1, 'Classic Graphite Portrait',   'portrait.jpg',   'Alice Perera',  1500.00, 'pencil, portrait, graphite',  'A stunning hand-drawn graphite portrait using detailed shading techniques.'),
(2, 'Watercolor Sunset',           'sunset.jpg',     'Ruwan Silva',   2200.00, 'watercolor, sunset, nature',  'A vibrant watercolor painting of a tropical sunset over the ocean.'),
(3, 'Abstract Canvas Art',         'abstract.jpg',   'Nimal Fernando',3500.00, 'canvas, abstract, modern',    'Bold abstract strokes on canvas capturing energy and movement.'),
(4, 'Digital Fantasy Landscape',   'fantasy.jpg',    'Sara Mendis',   1800.00, 'digital, fantasy, landscape', 'Digitally created fantasy landscape with stunning color grading.'),
(1, 'Pencil Sketch — Old Town',    'oldtown.jpg',    'Alice Perera',  1200.00, 'pencil, sketch, architecture','Detailed pencil sketch of an old colonial town street.'),
(2, 'Floral Watercolor Study',     'floral.jpg',     'Ruwan Silva',   1950.00, 'watercolor, floral, study',   'Delicate watercolor study of tropical flowers in full bloom.');

-- ============================================================
-- TABLE: slider
-- Stores homepage banner / hero slider images.
-- ============================================================
CREATE TABLE `slider` (
  `slide_id`    INT(10)      NOT NULL AUTO_INCREMENT,
  `slide_name`  VARCHAR(255) NOT NULL,
  `slide_image` TEXT         NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample slides
INSERT INTO `slider` (`slide_name`, `slide_image`) VALUES
('Slide number 1', 'slide-1.jpg'),
('Slide number 2', 'slide-2.jpg'),
('Slide number 3', 'slide-3.jpg');

-- ============================================================
-- TABLE: customers
-- Stores registered customer accounts.
-- customer_ip is used for guest-cart identification before login.
-- ============================================================
CREATE TABLE `customers` (
  `customer_id`      INT(10)       NOT NULL AUTO_INCREMENT,
  `customer_fname`   VARCHAR(255)  NOT NULL,
  `customer_lname`   VARCHAR(255)  NOT NULL,
  `customer_email`   VARCHAR(255)  NOT NULL UNIQUE,
  `customer_pass`    VARCHAR(255)  NOT NULL COMMENT 'Store hashed password',
  `customer_country` VARCHAR(100)  NOT NULL,
  `customer_city`    VARCHAR(100)  NOT NULL,
  `customer_address` VARCHAR(255)  NOT NULL,
  `customer_contact` VARCHAR(20)   NOT NULL,
  `customer_image`   TEXT          NOT NULL DEFAULT 'default.jpg',
  `customer_ip`      VARCHAR(45)   NOT NULL COMMENT 'Used for IP-based cart tracking',
  `registered_at`    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`),
  KEY `idx_customer_email` (`customer_email`),
  KEY `idx_customer_ip`    (`customer_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample customers
INSERT INTO `customers`
  (`customer_fname`, `customer_lname`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_address`, `customer_contact`, `customer_image`, `customer_ip`)
VALUES
  ('John',  'Doe',   'john@example.com',  'pass123', 'Sri Lanka', 'Colombo', 'No 10, Main Street',   '0711234567', 'default.jpg', '127.0.0.1'),
  ('Jane',  'Smith', 'jane@example.com',  'pass456', 'Sri Lanka', 'Kandy',   'No 5, Temple Road',    '0722345678', 'default.jpg', '127.0.0.2'),
  ('Tom',   'Perera','tom@example.com',   'pass789', 'Sri Lanka', 'Galle',   'No 22, Sea View Lane', '0733456789', 'default.jpg', '127.0.0.3');

-- ============================================================
-- TABLE: cart
-- Temporary shopping cart tracked by visitor IP address.
-- Products are matched to ip_add before the customer logs in.
-- ============================================================
CREATE TABLE `cart` (
  `cart_id` INT(10)      NOT NULL AUTO_INCREMENT,
  `p_id`    INT(10)      NOT NULL COMMENT 'FK → products',
  `ip_add`  VARCHAR(45)  NOT NULL COMMENT 'Visitor IP address',
  `qty`     INT(10)      NOT NULL DEFAULT 1,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `uq_cart_product_ip` (`p_id`, `ip_add`),
  KEY `fk_cart_product` (`p_id`),
  CONSTRAINT `fk_cart_product`
    FOREIGN KEY (`p_id`) REFERENCES `products` (`product_id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- TABLE: customer_orders
-- Master order record per customer checkout session.
-- One row = one checkout with a total due_amount.
-- ============================================================
CREATE TABLE `customer_orders` (
  `order_id`     INT(10)       NOT NULL AUTO_INCREMENT,
  `customer_id`  INT(10)       NOT NULL COMMENT 'FK → customers',
  `invoice_no`   INT(15)       NOT NULL UNIQUE,
  `due_amount`   DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `qty`          INT(10)       NOT NULL DEFAULT 1,
  `order_date`   DATE          NOT NULL,
  `order_status` ENUM('pending','Confirmed','Cancelled') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`order_id`),
  KEY `fk_co_customer` (`customer_id`),
  KEY `idx_co_invoice`  (`invoice_no`),
  CONSTRAINT `fk_co_customer`
    FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample orders
INSERT INTO `customer_orders` (`customer_id`, `invoice_no`, `due_amount`, `qty`, `order_date`, `order_status`) VALUES
(1, 100001, 3700.00, 2, '2026-05-01', 'Confirmed'),
(2, 100002, 2200.00, 1, '2026-05-03', 'pending'),
(3, 100003, 1800.00, 1, '2026-05-05', 'pending');

-- ============================================================
-- TABLE: pending_orders
-- Line-item detail of each order — one row per product per order.
-- ============================================================
CREATE TABLE `pending_orders` (
  `order_id`     INT(10) NOT NULL AUTO_INCREMENT,
  `customer_id`  INT(10) NOT NULL COMMENT 'FK → customers',
  `invoice_no`   INT(15) NOT NULL  COMMENT 'Links to customer_orders',
  `product_id`   INT(10) NOT NULL  COMMENT 'FK → products',
  `qty`          INT(10) NOT NULL DEFAULT 1,
  `order_status` ENUM('pending','Confirmed','Cancelled') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`order_id`),
  KEY `fk_po_customer`   (`customer_id`),
  KEY `fk_po_product`    (`product_id`),
  KEY `idx_po_invoice`   (`invoice_no`),
  CONSTRAINT `fk_po_customer`
    FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_po_product`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample pending order items
INSERT INTO `pending_orders` (`customer_id`, `invoice_no`, `product_id`, `qty`, `order_status`) VALUES
(1, 100001, 1, 1, 'Confirmed'),
(1, 100001, 3, 1, 'Confirmed'),
(2, 100002, 2, 1, 'pending'),
(3, 100003, 4, 1, 'pending');

-- ============================================================
-- TABLE: order_confirm
-- Stores customer shipping / confirmation details submitted
-- after checkout (name, email, phone, address).
-- Used in customer/confirm.php and viewed in admin view_payments.php.
-- ============================================================
CREATE TABLE `order_confirm` (
  `confirm_id`  INT(10)      NOT NULL AUTO_INCREMENT,
  `invoice_no`  INT(15)      NOT NULL COMMENT 'Links to customer_orders',
  `name`        VARCHAR(255) NOT NULL,
  `email`       VARCHAR(255) NOT NULL,
  `phone_no`    VARCHAR(20)  NOT NULL,
  `address`     VARCHAR(255) NOT NULL,
  `confirmed_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`confirm_id`),
  KEY `idx_oc_invoice` (`invoice_no`),
  CONSTRAINT `fk_oc_invoice`
    FOREIGN KEY (`invoice_no`) REFERENCES `customer_orders` (`invoice_no`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample confirmed orders
INSERT INTO `order_confirm` (`invoice_no`, `name`, `email`, `phone_no`, `address`) VALUES
(100001, 'John Doe', 'john@example.com', '0711234567', 'No 10, Main Street, Colombo');

-- ============================================================
-- TABLE: payments
-- Records payment bank slips uploaded by customers.
-- ============================================================
CREATE TABLE `payments` (
  `payment_id`    INT(10)       NOT NULL AUTO_INCREMENT,
  `invoice_no`    INT(15)       NOT NULL COMMENT 'Links to customer_orders',
  `amount`        DECIMAL(12,2) NOT NULL,
  `payment_date`  DATE          NOT NULL,
  `payment_slip`  TEXT          NOT NULL COMMENT 'Path to uploaded bank slip image',
  PRIMARY KEY (`payment_id`),
  KEY `fk_pay_invoice` (`invoice_no`),
  CONSTRAINT `fk_pay_invoice`
    FOREIGN KEY (`invoice_no`) REFERENCES `customer_orders` (`invoice_no`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample payment
INSERT INTO `payments` (`invoice_no`, `amount`, `payment_date`, `payment_slip`) VALUES
(100001, 3700.00, '2026-05-02', 'slip_100001.jpg');

-- ============================================================
-- TABLE: customer_messages
-- Contact form submissions from the Contact Us page.
-- ============================================================
CREATE TABLE `customer_messages` (
  `message_id`  INT(10)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NOT NULL,
  `email`       VARCHAR(100) NOT NULL,
  `message`     TEXT         NOT NULL,
  `sent_at`     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample messages
INSERT INTO `customer_messages` (`name`, `email`, `message`) VALUES
('Alice Buyer',  'alice@example.com', 'Hi, do you ship internationally?'),
('Bob Customer', 'bob@example.com',   'I would like to know about return policies.');

-- ============================================================
-- Re-enable FK checks
-- ============================================================
SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
