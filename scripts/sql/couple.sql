-- Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    couple_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Couples
CREATE TABLE couples (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invite_code VARCHAR(64) UNIQUE NOT NULL,
    created_by INT NOT NULL,
    partner1_id INT NULL,
    partner2_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Notes (example of feature table)
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    couple_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
