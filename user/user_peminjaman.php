<?php include '../partials/header.php'; ?>

<div class="min-h-screen p-6 flex items-center justify-center bg-[#ffccf6]">
  <div class="max-w-xl w-full bg-white shadow-md rounded-xl p-6">
    <h1 class="text-2xl font-bold text-[#ff8aed] mb-6 text-center">Form Tambah Peminjaman</h1>
    <form>
      <div class="mb-4">
        <label class="block font-semibold mb-1 text-gray-700">Nama Barang</label>
        <input type="text" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#ff8aed]" placeholder="Contoh: Kamera" />
      </div>
      <div class="mb-6">
        <label class="block font-semibold mb-1 text-gray-700">Tanggal Pinjam</label>
        <input type="date" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#ff8aed]" />
      </div>
      <button type="submit" class="w-full bg-[#ff8aed] text-white py-2 rounded hover:bg-pink-500 transition">Ajukan</button>
    </form>
  </div>
</div>

<?php include '../partials/footer.php'; ?>
