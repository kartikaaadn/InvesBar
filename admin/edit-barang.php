<?php
session_start();
require_once "../includes/db.php";

// Cek login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Pastikan parameter id ada
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = (int) $_GET['id'];

// Ambil data barang
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$barang = mysqli_fetch_assoc($result);

if (!$barang) {
    die("Barang tidak ditemukan.");
}

// Proses update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $lokasi = $_POST['lokasi'];
    $kondisi = $_POST['kondisi'];
    $stok = (int) $_POST['stok'];

    $update = mysqli_query($conn, "UPDATE barang SET 
        nama_barang = '$nama',
        jenis = '$jenis',
        lokasi = '$lokasi',
        kondisi = '$kondisi',
        stok = $stok
        WHERE id = $id");

    if ($update) {
        header("Location: barang.php?status=updated");
        exit;
    } else {
        $error = "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-purple-700">✏️ Edit Barang</h1>

    <?php if (isset($error)) : ?>
      <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
      <label class="block mb-2">Nama Barang</label>
      <input type="text" name="nama" value="<?= htmlspecialchars($barang['nama_barang']) ?>" class="w-full mb-4 p-2 border rounded" required>

      <label class="block mb-2">Jenis</label>
      <input type="text" name="jenis" value="<?= htmlspecialchars($barang['jenis']) ?>" class="w-full mb-4 p-2 border rounded" required>

      <label class="block mb-2">Lokasi</label>
      <input type="text" name="lokasi" value="<?= htmlspecialchars($barang['lokasi']) ?>" class="w-full mb-4 p-2 border rounded" required>

      <label class="block mb-2">Kondisi</label>
      <input type="text" name="kondisi" value="<?= htmlspecialchars($barang['kondisi']) ?>" class="w-full mb-4 p-2 border rounded" required>

      <label class="block mb-2">Stok</label>
      <input type="number" name="stok" value="<?= (int)$barang['stok'] ?>" class="w-full mb-4 p-2 border rounded" required>

      <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Simpan Perubahan</button>
      <a href="barang.php" class="ml-4 text-gray-600 hover:underline">Kembali</a>
    </form>
  </div>
</body>
</html>