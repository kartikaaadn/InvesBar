<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komponen Footer</title>
    <style>
        /* CSS yang dibutuhkan HANYA untuk styling footer */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-placeholder {
            flex-grow: 1;
            padding: 2rem;
        }

        .app-footer {
            background-color: #333;
            color: #f4f7f6;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto; /* Mendorong footer ke bawah */
        }
    </style>
</head>
<body>

    <div class="content-placeholder">
        <p>Ini adalah halaman <strong>footer.html</strong> yang dijalankan secara mandiri.</p>
    </div>

    <footer class="app-footer">
        <p>&copy; <span id="currentYear"></span> Assetify. All Rights Reserved.</p>
    </footer>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>

</body>
</html>