<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staf') {
    header("Location: ../login.php");
    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['user_id'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal_pinjam = date("Y-m-d");
    $tanggal_kembali = $_POST['tanggal_kembali']; // Ambil dari form input

    $insert = mysqli_query($conn, "INSERT INTO peminjaman 
        (id_user, id_barang, jumlah, tanggal_pinjam, tanggal_kembali, status)
        VALUES 
        ('$id_user', '$id_barang', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', 'dipinjam')");

    if ($insert) {
        $success = "Berhasil meminjam barang.";
    } else {
        $error = "Gagal meminjam barang.";
    }
}
?>

<?php include_once '../includes/header.php'; ?>

<div class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-6 mt-10">
    <h1 class="text-2xl font-bold text-purple-700 mb-4">📝 Form Peminjaman Barang</h1>

    <?php if (isset($success)): ?>
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4"><?= $success ?></div>
    <?php elseif (isset($error)): ?>
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <label for="id_barang" class="block text-sm font-medium text-gray-700">Pilih Barang</label>
            <select name="id_barang" id="id_barang" required class="w-full mt-1 p-2 border rounded">
                <option value="">-- Pilih --</option>
                <?php while ($b = mysqli_fetch_assoc($barang)): ?>
                    <option value="<?= $b['id'] ?>">
                        <?= $b['nama_barang'] ?> (<?= $b['stok'] ?> tersedia)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" min="1" required class="w-full mt-1 p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" required class="w-full mt-1 p-2 border rounded">
        </div>

        <div class="flex justify-between items-center">
            <a href="dashboard.php" class="text-purple-600 hover:underline text-sm">← Kembali ke Dashboard</a>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Pinjam</button>
        </div>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>