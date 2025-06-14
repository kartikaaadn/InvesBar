<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Inventaris Barang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-100 to-pink-100 min-h-screen">

<nav class="bg-purple-600 text-white px-6 py-4 flex justify-between items-center shadow">
  <h1 class="text-xl font-bold">📦 Inventaris Barang</h1>
  <div>
    <?php if (isset($_SESSION['username'])): ?>
      <span class="mr-4">👤 <?= htmlspecialchars($_SESSION['username']) ?> (<?= $_SESSION['role'] ?>)</span>
      <a href="../logout.php" class="bg-white text-purple-600 px-3 py-1 rounded hover:bg-gray-100">Logout</a>
    <?php else: ?>
      <a href="../login.php" class="bg-white text-purple-600 px-3 py-1 rounded hover:bg-gray-100">Login</a>
    <?php endif; ?>
  </div>
</nav>

<div class="p-6"></div>