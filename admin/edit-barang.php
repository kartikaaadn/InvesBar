<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Barang - InvesBar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-[#FFCCF6] to-[#FF8AED]">

<?php
// Simulasi data (nanti bisa diganti dari database)
$kode = $_GET['kode'] ?? '';
$barang = [
  'kode' => $kode,
  'nama' => 'Contoh Barang',
  'kategori' => 'Laptop',
  'tanggal_masuk' => '2025-06-10',
  'stok' => 12,
  'keterangan' => 'Contoh keterangan barang',
];
?>

<main class="p-6 max-w-3xl mx-auto">
  <h1 class="text-2xl font-bold text-pink-700 mb-4">Edit Barang</h1>

  <form action="#" method="POST" class="bg-white p-6 rounded-xl shadow-md space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-pink-700">Kode Barang</label>
        <input type="text" name="kode" value="<?= htmlspecialchars($barang['kode']) ?>" class="w-full border rounded px-3 py-2" readonly>
      </div>
      <div>
        <label class="block text-sm font-medium text-pink-700">Nama Barang</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($barang['nama']) ?>" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-pink-700">Kategori</label>
        <select name="kategori" class="w-full border rounded px-3 py-2" required>
          <option value="printer" <?= $barang['kategori'] == 'Printer' ? 'selected' : '' ?>>Printer</option>
          <option value="laptop" <?= $barang['kategori'] == 'Laptop' ? 'selected' : '' ?>>Laptop</option>
          <option value="proyektor" <?= $barang['kategori'] == 'Proyektor' ? 'selected' : '' ?>>Proyektor</option>
          <option value="lainnya" <?= $barang['kategori'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-pink-700">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" value="<?= $barang['tanggal_masuk'] ?>" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-pink-700">Stok</label>
        <input type="number" name="stok" value="<?= $barang['stok'] ?>" class="w-full border rounded px-3 py-2" required>
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-pink-700">Keterangan</label>
      <textarea name="keterangan" rows="3" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($barang['keterangan']) ?></textarea>
    </div>

    <div class="flex justify-between items-center">
      <a href="barang.php" class="text-pink-600 hover:underline">← Kembali</a>
      <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded">Simpan Perubahan</button>
    </div>
  </form>
</main>

</body>
</html>
