<?php
// create-table-doctors.php

include 'connect-database.php';

$createTableSQL = "CREATE TABLE IF NOT EXISTS doctors (
    doctor_id SMALLINT AUTO_INCREMENT PRIMARY KEY,
    doctor_name VARCHAR(30) NOT NULL,
    gender VARCHAR(7) NOT NULL,
    birth_date DATE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    doctor_address VARCHAR(200) NOT NULL,
    doctor_position VARCHAR(150) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($createTableSQL) === TRUE) {
    echo "Table 'doctors' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>