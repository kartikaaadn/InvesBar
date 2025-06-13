<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Peminjaman Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#FFCCF6] to-[#FF8AED] min-h-screen p-6">

  <div class="bg-white rounded-xl shadow-md p-6 max-w-6xl mx-auto">
    <!-- Tabs -->
    <div class="flex justify-center mb-6 space-x-4">
      <button onclick="showTab('peminjaman')" id="tabPeminjaman"
        class="px-4 py-2 border border-pink-500 rounded-full text-pink-500 hover:bg-pink-100 font-semibold focus:outline-none">
        Peminjaman
      </button>
      <button onclick="showTab('pengembalian')" id="tabPengembalian"
        class="px-4 py-2 border border-pink-500 rounded-full text-pink-500 hover:bg-pink-100 font-semibold focus:outline-none">
        Pengembalian
      </button>
    </div>

    <!-- Peminjaman -->
    <div id="peminjaman" class="tab-content">
      <h2 class="text-xl font-bold mb-4 text-pink-600">Data Peminjaman Barang</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center bg-white">
          <thead class="bg-pink-400 text-white">
            <tr>
              <th class="py-2 px-4 border">No</th>
              <th class="py-2 px-4 border">Nama Peminjam</th>
              <th class="py-2 px-4 border">Kode Barang</th>
              <th class="py-2 px-4 border">Nama Barang</th>
              <th class="py-2 px-4 border">Tanggal Pinjam</th>
              <th class="py-2 px-4 border">Tanggal Kembali</th>
              <th class="py-2 px-4 border">Status</th>
              <th class="py-2 px-4 border">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-pink-100">
              <td class="py-2 px-4 border">1</td>
              <td class="py-2 px-4 border">Lutfi Riskia</td>
              <td class="py-2 px-4 border text-pink-700 font-medium">BRG001</td>
              <td class="py-2 px-4 border">Proyektor Epson</td>
              <td class="py-2 px-4 border">2025-06-10</td>
              <td class="py-2 px-4 border">2025-06-15</td>
              <td class="py-2 px-4 border text-yellow-600 font-semibold">Dipinjam</td>
              <td class="py-2 px-4 border">
                <button onclick="hapusData(this)"
                  class="bg-red-500 hover:bg-red-600 active:scale-95 text-white px-3 py-1 rounded transition-all duration-200 ease-in-out shadow-md">
                  Hapus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pengembalian -->
    <div id="pengembalian" class="tab-content hidden">
      <h2 class="text-xl font-bold mb-4 text-pink-600">Data Pengembalian Barang</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center bg-white">
          <thead class="bg-pink-400 text-white">
            <tr>
              <th class="py-2 px-4 border">No</th>
              <th class="py-2 px-4 border">Nama Peminjam</th>
              <th class="py-2 px-4 border">Kode Barang</th>
              <th class="py-2 px-4 border">Nama Barang</th>
              <th class="py-2 px-4 border">Tanggal Kembali</th>
              <th class="py-2 px-4 border">Status</th>
              <th class="py-2 px-4 border">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-pink-100">
              <td class="py-2 px-4 border">1</td>
              <td class="py-2 px-4 border">Sari</td>
              <td class="py-2 px-4 border text-pink-700 font-medium">BRG002</td>
              <td class="py-2 px-4 border">Laptop HP</td>
              <td class="py-2 px-4 border">2025-06-11</td>
              <td class="py-2 px-4 border text-green-600 font-semibold">Dikembalikan</td>
              <td class="py-2 px-4 border">
                <button onclick="hapusData(this)"
                  class="bg-red-500 hover:bg-red-600 active:scale-95 text-white px-3 py-1 rounded transition-all duration-200 ease-in-out shadow-md">
                  Hapus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Script untuk tab toggle -->
  <script>
    function showTab(tab) {
      const peminjaman = document.getElementById("peminjaman");
      const pengembalian = document.getElementById("pengembalian");

      const tabPeminjaman = document.getElementById("tabPeminjaman");
      const tabPengembalian = document.getElementById("tabPengembalian");

      peminjaman.classList.add("hidden");
      pengembalian.classList.add("hidden");
      tabPeminjaman.classList.remove("bg-pink-500", "text-white");
      tabPengembalian.classList.remove("bg-pink-500", "text-white");

      if (tab === "peminjaman") {
        peminjaman.classList.remove("hidden");
        tabPeminjaman.classList.add("bg-pink-500", "text-white");
      } else {
        pengembalian.classList.remove("hidden");
        tabPengembalian.classList.add("bg-pink-500", "text-white");
      }
    }

    function hapusData(button) {
      if (confirm("Yakin ingin menghapus data ini?")) {
        const row = button.closest('tr');
        row.remove(); // Hapus baris dari tabel
        alert("Data berhasil dihapus!");
      }
    }
  </script>

</body>
</html>
