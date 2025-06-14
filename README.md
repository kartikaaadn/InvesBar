
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

📸 **Disarankan Screenshot:** `assets/img/stored-procedure-pinjam.png`

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

* Kartika AADN
* 

