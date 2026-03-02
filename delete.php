<?php
include 'connect-database.php';
date_default_timezone_set("Asia/Phnom_Penh");

if (isset($_GET["id"])) {

    $id = $_GET["id"];
    $update_at = date('Y-m-d H:i:s');

    // Prepared statement (SAFE)
    $stmt = $conn->prepare("UPDATE doctors 
                            SET is_active = 0, update_at = ? 
                            WHERE doctor_id = ?");

    $stmt->bind_param("si", $update_at, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Delete failed: " . $stmt->error;
    }

    $stmt->close();
}
?>