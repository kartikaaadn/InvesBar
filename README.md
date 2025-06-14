# 📦 InvesBar – Sistem Informasi Inventaris Barang

**InvesBar** adalah aplikasi web yang digunakan untuk mencatat dan mengelola inventaris barang serta proses peminjaman dan pengembalian di lingkungan organisasi. Sistem ini dikembangkan menggunakan **PHP Native** dan **MySQL**, serta dilengkapi fitur manajemen pengguna, peminjaman barang, dan backup otomatis. Selain itu, sistem ini mengimplementasikan **stored procedure**, **trigger**, **transaction**, dan **stored function** untuk menjaga integritas dan efisiensi data.

![Home](assets/img/home.png)

---

## ✨ Fitur Utama

- 👥 Manajemen pengguna (admin & staf)
- 📦 Manajemen data barang (CRUD)
- 🗑️ Peminjaman dan pengembalian barang
- 🔄 Pemrosesan otomatis melalui trigger dan procedure
- 📂 Backup database otomatis via script
- 🔐 Login aman dengan bcrypt

---

## 🗃 Struktur Tabel

- **users**: Menyimpan data pengguna dan role (admin/staf)
- **barang**: Menyimpan data inventaris barang
- **peminjaman**: Menyimpan data transaksi peminjaman dan pengembalian barang

---

## ⚙ Stored Procedure

### 📌 1. `pinjam_barang`

Digunakan untuk mencatat peminjaman dan langsung mengurangi stok barang.

```sql
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


