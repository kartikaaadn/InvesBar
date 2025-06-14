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
