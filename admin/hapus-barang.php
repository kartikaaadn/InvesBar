<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

    if ($query) {
        header("Location: barang.php?status=deleted");
    } else {
        echo "<script>alert('Gagal menghapus data barang!'); window.location='barang.php';</script>";
    }
} else {
    header("Location: barang.php");
}
?>
