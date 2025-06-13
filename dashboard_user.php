<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard User - Assetify</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif'],
          },
          colors: {
            pinklight: '#ffe0f4',
            pinkmain: '#FFBAED',
            pinkhover: '#f7aee0',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-pinklight font-poppins min-h-screen flex flex-col">

  <!-- HEADER -->
  <header class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
      <img src="Photo/logo.png" class="h-10" alt="Assetify Logo">
      <nav class="space-x-6 text-gray-600 font-medium">
        <a href="#" class="hover:text-pink-400">Dashboard</a>
        <a href="admin/barang.php" class="hover:text-pink-400">Data Barang</a>
        <a href="admin/data-peminjaman.php" class="hover:text-pink-400">Data Peminjam</a>
        <a href="admin/admin_riwayat.php" class="hover:text-pink-400">Riwayat</a>
      </nav>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700">Selamat datang, <?= $_SESSION['nama'] ?? 'Admin' ?>!</span>
      <a href="logout.php">
        <button class="bg-pinkmain hover:bg-pinkhover text-gray-800 px-4 py-2 rounded font-semibold">Logout</button>
      </a>
    </div>
  </header>

  <!-- MAIN -->
  <main class="flex-grow p-6 text-center">
    <h1 class="text-3xl font-bold text-pinkmain mb-2">Dashboard Admin</h1>
    <p class="text-gray-700">Selamat datang di panel admin Assetify.</p>
  </main>

  <!-- FOOTER -->
  <footer class="bg-gray-800 text-white text-center p-4">
    &copy; <span id="currentYear"></span> Assetify. All Rights Reserved.
  </footer>
  <script>document.getElementById('currentYear').textContent = new Date().getFullYear();</script>

</body>
</html>
