<?php
require_once "includes/db.php";

$adminPassword = password_hash("admin123", PASSWORD_DEFAULT);
$stafPassword  = password_hash("staf123", PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, role) VALUES 
    ('admin', '$adminPassword', 'admin'),
    ('staf1', '$stafPassword', 'staf')";

if (mysqli_query($conn, $sql)) {
    echo "Berhasil menambahkan admin dan staf!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
