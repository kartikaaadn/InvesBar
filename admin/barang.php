<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Barang - InvesBar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-[#FFCCF6] to-[#FF8AED]">

  <header class="bg-white shadow p-4">
    <h1 class="text-xl font-bold text-pink-600">Data Barang</h1>
  </header>

  <main class="p-6">
    <div class="flex justify-end mb-4">
      <a href="tambah-barang.php" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-4 py-2 rounded shadow">
        + Tambah Barang
      </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow-md">
      <table class="min-w-full divide-y divide-pink-200">
        <thead class="bg-pink-100">
          <tr>
            <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Kode</th>
            <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Nama</th>
            <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Kategori</th>
            <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Tanggal Masuk</th>
            <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Stok</th>
            <th class="text-center text-sm font-medium text-pink-700 px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-pink-100">
          <?php
          // Simulasi data
          $data_barang = [
            ['kode' => 'BRG001', 'nama' => 'Laptop ASUS', 'kategori' => 'Laptop', 'tanggal' => '2025-06-10', 'stok' => 10],
            ['kode' => 'BRG002', 'nama' => 'Printer Epson', 'kategori' => 'Printer', 'tanggal' => '2025-06-09', 'stok' => 5],
          ];

          foreach ($data_barang as $barang) {
            echo "<tr class='hover:bg-pink-50'>
              <td class='px-4 py-2 text-sm text-pink-900'>{$barang['kode']}</td>
              <td class='px-4 py-2 text-sm text-pink-900'>{$barang['nama']}</td>
              <td class='px-4 py-2 text-sm text-pink-900'>{$barang['kategori']}</td>
              <td class='px-4 py-2 text-sm text-pink-900'>{$barang['tanggal']}</td>
              <td class='px-4 py-2 text-sm text-pink-900'>{$barang['stok']}</td>
              <td class='px-4 py-2 text-sm text-center'>
                <a href='edit-barang.php?kode={$barang['kode']}' class='bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm mr-2'>Edit</a>
                <a href='hapus-barang.php?kode={$barang['kode']}' onclick=\"return confirm('Yakin ingin menghapus?')\" class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm'>Hapus</a>
              </td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="text-center text-sm text-pink-700 mt-10 mb-4">
    &copy; 2025 InvesBar. All rights reserved.
  </footer>

</body>
</html>
