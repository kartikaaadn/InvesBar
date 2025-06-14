<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staf') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['user_id'];

$query = mysqli_query($conn, "
    SELECT p.*, b.nama_barang 
    FROM peminjaman p 
    JOIN barang b ON p.id_barang = b.id 
    WHERE p.id_user = $id_user 
    ORDER BY p.tanggal_pinjam DESC
");
?>

<?php include_once '../includes/header.php'; ?>

<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">📄 Status Peminjaman Barang</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-purple-200 text-purple-800">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Barang</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Tanggal Kembali</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?= $no++ ?></td>
                        <td class="px-4 py-2"><?= $row['nama_barang'] ?></td>
                        <td class="px-4 py-2"><?= $row['jumlah'] ?></td>
                        <td class="px-4 py-2"><?= $row['tanggal_pinjam'] ?></td>
                        <td class="px-4 py-2"><?= $row['tanggal_kembali'] ?? '-' ?></td>
                        <td class="px-4 py-2">
                            <?php if ($row['status'] === 'dipinjam'): ?>
                                <span class="text-yellow-600 font-semibold">Dipinjam</span>
                            <?php else: ?>
                                <span class="text-green-600 font-semibold">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="dashboard.php" class="inline-block text-sm text-purple-600 hover:underline mt-4">← Kembali ke Dashboard</a>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>