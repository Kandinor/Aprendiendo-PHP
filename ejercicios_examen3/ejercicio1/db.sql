CREATE TABLE estafas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fraud_url VARCHAR(255) NOT NULL,
    fraud_type INT NOT NULL,
    description TEXT NOT NULL,
    phone VARCHAR(255),
    report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role INT NOT NULL
);

-- Algunos inserts de ejemplo

INSERT INTO usuarios (username, role, password) VALUES 
    ('admin', 0, '$2y$10$6EwZm4QoVNZpC3Mv4qY3Q.ttJ9sHvgcIkDeIt902CBIoSL/79Lcx.'),
    ('paco', 1, '$2y$10$0RpPoozo.8kcqfi1sxAXheYZG9JedWKCA9zwXMFFsuk0TutFj6kZC'),
    ('mar', 1, '$2y$10$lFuAL5rkprRz/7B1CdO7te9XnkW1k8VD5F9f4VQqkXwaWql8DDuDm');