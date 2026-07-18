USE uts3;

-- Drop the table if it already exists so you can start fresh
DROP TABLE IF EXISTS bukupro;

-- Create the new bukupro table (uncommented so it actually runs)
CREATE TABLE bukupro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(20) NOT NULL UNIQUE,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(150) NOT NULL,
    tahun YEAR NOT NULL,
    stok INT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert data into the correct table name: bukupro
INSERT INTO bukupro (isbn, judul, penulis, tahun, stok)
VALUES
('9786020324781','Pemrograman PHP','Abdul Kadir',2023,10),
('9789792971342','Basis Data','Bambang Hariyanto',2022,7),
('9786022915635','CodeIgniter 4','Jubilee Enterprise',2024,15);