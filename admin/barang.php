<?php
session_start();
$_SESSION['role'] = 'admin'; // sementara untuk tes (nanti diganti saat login)
?>

<?php include '../partials/header.php'; ?>

<main class="max-w-6xl mx-auto min-h-screen py-10">
  <h1 class="text-2xl font-bold text-[#ff8aed] mb-6">Data Barang</h1>

  <?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="flex justify-end mb-4">
      <a href="tambah-barang.php" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-4 py-2 rounded shadow">
        + Tambah Barang
      </a>
    </div>
  <?php endif; ?>

  <div class="overflow-x-auto bg-white rounded-xl shadow-md">
    <table class="min-w-full divide-y divide-pink-200">
      <thead class="bg-pink-100">
        <tr>
          <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Kode</th>
          <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Nama</th>
          <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Kategori</th>
          <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Tanggal Masuk</th>
          <th class="text-left text-sm font-medium text-pink-700 px-4 py-2">Stok</th>
          <?php if ($_SESSION['role'] === 'admin'): ?>
            <th class="text-center text-sm font-medium text-pink-700 px-4 py-2">Aksi</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody class="divide-y divide-pink-100">
        <?php
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
            <td class='px-4 py-2 text-sm text-pink-900'>{$barang['stok']}</td>";

          if ($_SESSION['role'] === 'admin') {
            echo "<td class='px-4 py-2 text-sm text-center'>
                    <a href='edit-barang.php?kode={$barang['kode']}' class='bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm mr-2'>Edit</a>
                    <a href='hapus-barang.php?kode={$barang['kode']}' onclick=\"return confirm('Yakin ingin menghapus?')\" class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm'>Hapus</a>
                  </td>";
          }

          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</main>

<?php include '../partials/footer.php'; ?>
