<?php
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan jika kamu belum set password
$db   = "invesbar_db"; // Ganti sesuai nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
