CREATE DATABASE IF NOT EXISTS simple_api;
USE simple_api;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    adress VARCHAR(100) NOT NULL,
    phone VARCHAR (25) NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    note VARCHAR(500) NOT NULL 
);

-- Insert dummy values into the users table
INSERT INTO users (first_name, last_name, adress,phone, email, note) VALUES
('John', 'Doe', 'tabanan', '(+62)123456789', 'john@example.com', 'test1'),
('Jane', 'Doe', 'denpasar', '(+62)896712345', 'jane@example.com', 'test2'),
('Mike', 'Smith', 'mengwi', '(+62)85424156', 'mike@example.com', 'test3'),
('Lisa', 'Jones', 'nusa penida', '(+62)825437345', 'lisa@example.com', 'test4'),
('Steve', 'Brown', 'gianyar', '(+62)8725463324', 'steve@example.com', 'test5');

-- Create a new user for the database
CREATE USER 'rest_api_demo'@'localhost' IDENTIFIED BY 'rest_api_demo';

-- Grant DML privileges to the new user on the simple_api database
GRANT SELECT, INSERT, UPDATE, DELETE ON simple_api.* TO 'rest_api_demo'@'localhost';

-- Apply the changes
FLUSH PRIVILEGES;