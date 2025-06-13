<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman Selesai</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#ffccf6] min-h-screen p-6">
  <div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold text-[#ff8aed] mb-6">Riwayat Peminjaman</h1>
    <table class="w-full bg-white border rounded shadow-md">
      <thead class="bg-[#ff8aed]/20">
        <tr>
          <th class="py-2 px-4 text-left">No</th>
          <th class="py-2 px-4 text-left">Nama Barang</th>
          <th class="py-2 px-4 text-left">Peminjam</th>
          <th class="py-2 px-4 text-left">Tanggal Pinjam</th>
          <th class="py-2 px-4 text-left">Tanggal Kembali</th>
          <th class="py-2 px-4 text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Baris hanya untuk status Selesai -->
        <tr class="border-t">
          <td class="py-2 px-4">1</td>
          <td class="py-2 px-4">Kamera Canon</td>
          <td class="py-2 px-4">Dwi Andini</td>
          <td class="py-2 px-4">2025-06-01</td>
          <td class="py-2 px-4">2025-06-03</td>
          <td class="py-2 px-4 text-green-600 font-semibold">Selesai</td>
        </tr>
        <tr class="border-t">
          <td class="py-2 px-4">2</td>
          <td class="py-2 px-4">Printer Epson L3110</td>
          <td class="py-2 px-4">Rina Putri</td>
          <td class="py-2 px-4">2025-05-20</td>
          <td class="py-2 px-4">2025-05-22</td>
          <td class="py-2 px-4 text-green-600 font-semibold">Selesai</td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
      </tbody>
    </table>
  </div>
</body>
</html>
