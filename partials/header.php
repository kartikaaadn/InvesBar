<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Assetify</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts (optional, bisa diganti dengan Tailwind) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #ffe0f4; /* Warna latar belakang pink muda */
        }

        .logout-btn {
            background-color: #FFBAED;
            color: #333;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: #f7aee0;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="Photo/logo.png" alt="Assetify Logo" class="h-10">
            <nav class="space-x-6 text-gray-600 font-medium">
                <a href="#" class="hover:text-pink-400">Dashboard</a>
                <a href="#" class="hover:text-pink-400">Daftar Barang</a>
                <a href="#" class="hover:text-pink-400">Tambah Barang</a>
                <a href="#" class="hover:text-pink-400">Laporan</a>
            </nav>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700">Selamat datang, Cici!</span>
            <a href="#"><button class="logout-btn">Logout</button></a>
        </div>
    </header>
