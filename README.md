
# 📦 InvesBar – Sistem Informasi Inventaris Barang

**InvesBar** adalah aplikasi web yang digunakan untuk mencatat dan mengelola inventaris barang serta proses peminjaman dan pengembalian di lingkungan organisasi. Sistem ini dikembangkan menggunakan **PHP Native** dan **MySQL**, serta dilengkapi fitur manajemen pengguna, peminjaman barang, dan backup otomatis. Selain itu, sistem ini mengimplementasikan **stored procedure**, **trigger**, **transaction**, dan **stored function** untuk menjaga integritas dan efisiensi data.

![Home](assets/img/home.png)

---

## ✨ Fitur Utama

- 👥 Manajemen pengguna (admin & staf)
- 📦 Manajemen data barang (CRUD)
- 📝 Peminjaman dan pengembalian barang
- 🔄 Pemrosesan otomatis melalui trigger dan procedure
- 💾 Backup database otomatis via script
- 🔐 Login aman dengan bcrypt

---

## 🗃 Struktur Tabel

- **users**: Menyimpan data pengguna dan role (admin/staf)
- **barang**: Menyimpan data inventaris barang
- **peminjaman**: Menyimpan data transaksi peminjaman dan pengembalian barang

---

## ⚙ Stored Procedure
Procedure `pinjam_barang` digunakan untuk mencatat transaksi peminjaman dan otomatis mengurangi stok barang jika stok mencukupi.

sql
DELIMITER //

CREATE PROCEDURE pinjam_barang (
    IN p_id_user INT,
    IN p_id_barang INT,
    IN p_jumlah INT,
    IN p_tanggal DATE
)
BEGIN
    DECLARE stok_tersedia INT;

    SELECT stok INTO stok_tersedia FROM barang WHERE id = p_id_barang;

    IF stok_tersedia >= p_jumlah THEN
        INSERT INTO peminjaman (id_user, id_barang, jumlah, tanggal_pinjam, status)
        VALUES (p_id_user, p_id_barang, p_jumlah, p_tanggal, 'dipinjam');

        UPDATE barang SET stok = stok - p_jumlah WHERE id = p_id_barang;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak mencukupi.';
    END IF;
END //

DELIMITER ;
`


Procedure `pinjam_barang` digunakan untuk mencatat transaksi peminjaman dan otomatis mengurangi stok barang jika stok mencukupi.
📌 1. pinjam_barang
Stored procedure ini digunakan untuk menambahkan peminjaman baru dan otomatis mengurangi stok barang yang dipinjam.

Lokasi File:
staf/pinjam.php

Penjelasan Fungsi:
pinjam_barang(p_id_user, p_id_barang, p_jumlah, p_tanggal_pinjam)
Digunakan saat staf melakukan peminjaman barang. Procedure akan menyimpan data peminjaman ke tabel peminjaman dan mengurangi stok barang.

Contoh Pemanggilan di PHP:
php
Copy
Edit
<?php
require '../includes/db.php'; // koneksi ke database

$id_user = $_SESSION['user_id'];
$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];
$tanggal_pinjam = date('Y-m-d');

// Call the pinjam_barang stored procedure
$stmt = $conn->prepare("CALL pinjam_barang(?, ?, ?, ?)");
$stmt->bind_param("iiis", $id_user, $id_barang, $jumlah, $tanggal_pinjam);

if ($stmt->execute()) {
    echo "✅ Peminjaman berhasil dicatat!";
} else {
    echo "❌ Gagal meminjam: " . $conn->error;
}
$stmt->close();
?>
📌 2. tambah_barang_baru
Stored procedure ini digunakan untuk menambahkan data barang baru ke tabel barang.

Lokasi File:
admin/tambah-barang.php

Penjelasan Fungsi:
tambah_barang_baru(p_nama_barang, p_deskripsi, p_stok)
Memasukkan barang baru ke dalam tabel barang saat admin menambahkan item ke inventaris.

Contoh Pemanggilan di PHP:
php
Copy
Edit
<?php
require '../includes/db.php'; // koneksi ke database

$nama_barang = $_POST['nama_barang'];
$deskripsi = $_POST['deskripsi'];
$stok = $_POST['stok'];

// Call the tambah_barang_baru stored procedure
$stmt = $conn->prepare("CALL tambah_barang_baru(?, ?, ?)");
$stmt->bind_param("ssi", $nama_barang, $deskripsi, $stok);

if ($stmt->execute()) {
    echo "✅ Barang berhasil ditambahkan!";
} else {
    echo "❌ Gagal menambahkan barang: " . $conn->error;
}
$stmt->close();
?>
`

📸 **Disarankan Screenshot:** `assets/img/stored-procedure-peminjama`

---

## 🔄 Trigger

Trigger `kembalikan_barang` akan menambah stok barang secara otomatis saat status peminjaman diubah menjadi "dikembalikan".

sql
DELIMITER //

CREATE TRIGGER kembalikan_barang
AFTER UPDATE ON peminjaman
FOR EACH ROW
BEGIN
    IF OLD.status = 'dipinjam' AND NEW.status = 'dikembalikan' THEN
        UPDATE barang
        SET stok = stok + OLD.jumlah
        WHERE id = OLD.id_barang;
    END IF;
END //

DELIMITER ;

penjelasan tentang triggernya

Trigger kurangi_stok_setelah_transaksi secara otomatis aktif setiap kali sistem melakukan proses pencatatan transaksi baru di tabel transaksi:

✅ Contoh pemicu aktivasi trigger:
sql
Copy
Edit
INSERT INTO transaksi (id_barang, jumlah, tanggal_transaksi, keterangan)
VALUES (3, 2, CURDATE(), 'Peminjaman proyektor untuk rapat mingguan');
🔄 Beberapa peran trigger ini dalam sistem:
Otomatis mengurangi stok barang
Saat transaksi dicatat (misalnya barang digunakan/peminjaman), trigger langsung mengurangi nilai stok di tabel barang berdasarkan id_barang dan jumlah yang tercatat.

Menjamin konsistensi antara transaksi dan stok barang
Meskipun sistem frontend atau aplikasi lupa memperbarui stok, trigger ini akan memastikan perubahan tetap dilakukan secara otomatis dan sinkron.

Mencegah manipulasi stok secara manual dari luar prosedur resmi
Dengan trigger ini, tidak ada celah untuk menambahkan transaksi namun lupa atau sengaja tidak mengubah stok barang.

Mengurangi beban logika validasi di aplikasi (PHP)
Karena logika pengurangan stok terjadi langsung di database, aplikasi tidak perlu menangani proses ini secara eksplisit, meningkatkan reliabilitas sistem.


📸 **Disarankan Screenshot:** `assets/img/trigger-kembalikan.png`

---

## 🔁 Transaction (PHP)

Untuk menjamin konsistensi data saat melakukan peminjaman barang, digunakan konsep transaksi dalam PHP.

php
mysqli_begin_transaction($conn);

try {
    mysqli_query($conn, $query_insert);
    mysqli_query($conn, $query_update_stok);

    mysqli_commit($conn);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Gagal melakukan peminjaman.";
}


📸 **Disarankan Screenshot:** `assets/img/transaction-php.png`

---

## 🧠 Stored Function

Function `total_barang_dipinjam` mengembalikan total jumlah barang yang sedang dipinjam oleh satu pengguna.

sql
DELIMITER //

CREATE FUNCTION total_barang_dipinjam(p_user_id INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE total INT;
    SELECT SUM(jumlah) INTO total
    FROM peminjaman
    WHERE id_user = p_user_id AND status = 'dipinjam';
    RETURN IFNULL(total, 0);
END //

DELIMITER ;

ini penjelasan untuk function

📄 Lokasi Tampilan: dashboard_user.php
php
Copy
Edit
$totalPinjam = $peminjamanModel->totalPeminjamanUser($userId);
html
Copy
Edit
<div class="text-center mt-3">
    <h5>Total Peminjaman</h5>
    <p class="fw-bold fs-4"><?= $totalPinjam ?> barang</p>
</div>

💼 Validasi Stok di Procedure pinjam_barang
sql
Copy
Edit
SET v_stok = get_stok_barang(p_id_barang);

IF v_stok < p_jumlah THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Stok barang tidak mencukupi',
        MYSQL_ERRNO = 1647;
END IF;


📸 **Disarankan Screenshot:** `assets/img/function-total-pinjaman.png`

---

## 🗂 Backup Otomatis

#!/bin/bash

# Nama database
DB_NAME="invesbar_db"

# Nama user MySQL
DB_USER="root"

# Password MySQL (jika kosong, hapus bagian -p)
DB_PASS="YourPassword"

# Lokasi folder backup (buat folder ini jika belum ada)
BACKUP_DIR="/home/username/backup/invesbar"

# Format nama file: invesbar_YYYY-MM-DD-HHMM.sql
TIMESTAMP=$(date +"%F-%H%M")
BACKUP_FILE="$BACKUP_DIR/invesbar_${TIMESTAMP}.sql"

# Eksekusi backup
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_FILE

# Konfirmasi
echo "Backup selesai: $BACKUP_FILE"


📸 **Disarankan Screenshot:** `assets/img/backup-script.png`

---

## 🖼 Tampilan Aplikasi

* **Dashboard**
  ![Dashboard](assets/img/dashboard.png)

* **Form Peminjaman**
  ![Form](assets/img/form-pinjam.png)

* **Riwayat Pengembalian**
  ![Riwayat](assets/img/riwayat-kembali.png)

---

## 💻 Teknologi yang Digunakan

* PHP Native
* MySQL
* HTML, CSS (Bootstrap)
* JavaScript (sedikit interaksi)
* phpMyAdmin (untuk manajemen DB)

---

## 🚀 Cara Menjalankan Proyek

1. **Clone repositori:**

   bash
   git clone https://github.com/kartikaaadn/InvesBar.git
   

2. **Import database:**

   * Buka `phpMyAdmin` → Import file `invesbar_db.sql`.

3. **Edit koneksi database di `config/koneksi.php`:**

   php
   $conn = new mysqli("localhost", "root", "", "invesbar_db");
   

4. **Jalankan di browser:**

   * Buka `http://localhost/InvesBar/`

---

## 👩‍💻 Developer

* kartikaadn
* dwiandini01
* Chelseayetri

