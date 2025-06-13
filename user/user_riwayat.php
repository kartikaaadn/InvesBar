<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#ffccf6] min-h-screen p-6">
  <div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-[#ff8aed] mb-6">Riwayat Peminjaman </h1>
    <table class="w-full bg-white border rounded shadow-md">
      <thead class="bg-[#ff8aed]/20">
        <tr>
          <th class="py-2 px-4 text-left">No</th>
          <th class="py-2 px-4 text-left">Nama Barang</th>
          <th class="py-2 px-4 text-left">Tanggal Pinjam</th>
          <th class="py-2 px-4 text-left">Tanggal Kembali</th>
          <th class="py-2 px-4 text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-t">
          <td class="py-2 px-4">1</td>
          <td class="py-2 px-4">Tripod</td>
          <td class="py-2 px-4">2025-06-10</td>
          <td class="py-2 px-4">2025-06-11</td>
          <td class="py-2 px-4 text-blue-600">Selesai</td>
        </tr>
        <!-- Tambahkan baris lain sesuai data -->
      </tbody>
    </table>
  </div>
</body>
</html>
