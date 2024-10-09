-- admin : asna : asna123
-- user : churri : churri3
-- Membuat Database
CREATE DATABASE IF NOT EXISTS alkesmedika;
USE alkesmedika;

-- Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dob DATE,
    gender ENUM('Male', 'Female'),
    address TEXT,
    city VARCHAR(50),
    contact_no VARCHAR(15),
    paypal_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Menambahkan Pengguna Awal
INSERT INTO users (username, password, email, dob, gender, address, city, contact_no, paypal_id) VALUES
('user1', '$2y$10$5j3F9x8fTn0VxL1xQeBbUOwQsBjqVV/2x4gNqlqXGx9Kz1oPnCgFy', 'user1@example.com', '1990-05-15', 'Male', 'Jl. Merdeka No.1', 'Jakarta', '081234567890', 'user1@paypal.com'), -- Password: userpass1
('user2', '$2y$10$P9J6FJ6GxYF1xQeBbUOwQsBjqVV/2x4gNqlqXGx9Kz1oPnCgFy', 'user2@example.com', '1985-08-22', 'Female', 'Jl. Sudirman No.2', 'Bandung', '081298765432', 'user2@paypal.com'); -- Password: userpass2

-- Tabel Categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Menambahkan Kategori Awal
INSERT INTO categories (name, description) VALUES
('Peralatan Medis', 'Peralatan medis untuk penggunaan rumah sakit dan klinik.'),
('Alat Kesehatan Pribadi', 'Alat kesehatan yang digunakan oleh individu untuk perawatan diri.'),
('Suplementasi', 'Suplemen kesehatan dan nutrisi.'),
('Peralatan Diagnostik', 'Alat untuk diagnostik dan pemeriksaan kesehatan.');

-- Tabel Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Menambahkan Produk Awal
INSERT INTO products (category_id, name, description, price, image, stock) VALUES
(1, 'Stetoskop', 'Stetoskop berkualitas tinggi untuk pemeriksaan medis.', 150000.00, 'stetoskop.jpg', 50),
(2, 'Termometer Digital', 'Termometer digital cepat dan akurat.', 50000.00, 'termometer_digital.jpg', 100),
(3, 'Vitamin C 1000mg', 'Suplemen Vitamin C untuk meningkatkan daya tahan tubuh.', 20000.00, 'vitamin_c.jpg', 200),
(4, 'Glukometer', 'Alat pengukur gula darah dengan fitur mudah digunakan.', 300000.00, 'glukometer.jpg', 30);

-- Tabel Orders
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    payment_method ENUM('Prepaid', 'Postpaid') NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected', 'Shipped') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Menambahkan Pesanan Awal
INSERT INTO orders (user_id, total, payment_method, status) VALUES
(1, 200000.00, 'Prepaid', 'Pending'),
(2, 350000.00, 'Postpaid', 'Shipped');

-- Tabel Order Items
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Menambahkan Item Pesanan Awal
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 150000.00),
(1, 3, 2, 20000.00),
(2, 2, 2, 50000.00),
(2, 4, 1, 300000.00);

-- Tabel Admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Menambahkan Admin Awal
INSERT INTO admin (username, password, email) VALUES
('admin1', '$2y$10$e0NRW6Qv8fQx/1kJ1B0aYeYVzzkBVXvlFZ8URmxdxI2r1PUKJ6j8K', 'admin1@alkesmedika.com'), -- Password: adminpass1
('admin2', '$2y$10$Cjv5fHlWmYc.N3JD7x3u4uKQZP0LRL3GXJuC3hE2OqB1/TGFW3R6G', 'admin2@alkesmedika.com'); -- Password: adminpass2

-- Tabel Guest Book
CREATE TABLE IF NOT EXISTS guest_book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Menambahkan Entri Guest Book Awal
INSERT INTO guest_book (name, email, message) VALUES
('Budi Santoso', 'budi.santoso@example.com', 'Website AlkesMEDIKA sangat membantu!'),
('Siti Aminah', 'siti.aminah@example.com', 'Terima kasih atas layanan yang cepat.'),
('Andi Wijaya', 'andi.wijaya@example.com', 'Produk-produk yang ditawarkan lengkap dan berkualitas.');

-- Tabel Shop Requests
CREATE TABLE IF NOT EXISTS shop_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    requester_name VARCHAR(100) NOT NULL,
    requester_email VARCHAR(100) NOT NULL,
    shop_name VARCHAR(100) NOT NULL,
    shop_description TEXT,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Menambahkan Permintaan Toko Awal
INSERT INTO shop_requests (requester_name, requester_email, shop_name, shop_description) VALUES
('Rina Putri', 'rina.putri@example.com', 'Toko Medika Rina', 'Menjual alat kesehatan dan suplemen.'),
('Dedi Kurniawan', 'dedi.kurniawan@example.com', 'Medis Dedi', 'Peralatan medis untuk rumah sakit dan klinik.');

-- Tabel Feedback
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    rating INT CHECK (rating >=1 AND rating <=5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Menambahkan Umpan Balik Awal
INSERT INTO feedback (user_id, rating, comment) VALUES
(1, 5, 'Pelayanan cepat dan produk sesuai deskripsi.'),
(2, 4, 'Pengiriman tepat waktu, namun kemasan bisa lebih rapat.');
