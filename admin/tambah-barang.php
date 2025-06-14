<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jenis = $_POST['jenis'];
    $lokasi = $_POST['lokasi'];
    $kondisi = $_POST['kondisi'];
    $stok = $_POST['stok'];

    $query = mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, jenis, lokasi, kondisi, stok) VALUES 
    ('$kode_barang', '$nama_barang', '$jenis', '$lokasi', '$kondisi', '$stok')");

    if ($query) {
        header("Location: barang.php?status=berhasil");
    } else {
        echo "<script>alert('Gagal menambahkan barang!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-purple-100 to-pink-100 min-h-screen p-6">

  <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-xl">
    <h2 class="text-2xl font-bold text-purple-700 mb-4">➕ Tambah Barang Inventaris</h2>

    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm mb-1">Kode Barang</label>
        <input type="text" name="kode_barang" required class="w-full px-4 py-2 border rounded-md" />
      </div>

      <div>
        <label class="block text-sm mb-1">Nama Barang</label>
        <input type="text" name="nama_barang" required class="w-full px-4 py-2 border rounded-md" />
      </div>

      <div>
        <label class="block text-sm mb-1">Jenis</label>
        <input type="text" name="jenis" required class="w-full px-4 py-2 border rounded-md" />
      </div>

      <div>
        <label class="block text-sm mb-1">Lokasi</label>
        <input type="text" name="lokasi" required class="w-full px-4 py-2 border rounded-md" />
      </div>

      <div>
        <label class="block text-sm mb-1">Kondisi</label>
        <select name="kondisi" required class="w-full px-4 py-2 border rounded-md">
          <option value="">-- Pilih --</option>
          <option value="baik">Baik</option>
          <option value="rusak">Rusak</option>
        </select>
      </div>

      <div>
        <label class="block text-sm mb-1">Stok</label>
        <input type="number" name="stok" min="0" required class="w-full px-4 py-2 border rounded-md" />
      </div>

      <div class="flex justify-between items-center">
        <a href="barang.php" class="text-sm text-gray-500 hover:underline">← Kembali</a>
        <button type="submit" name="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">Simpan</button>
      </div>
    </form>
  </div>

</body>
</html>