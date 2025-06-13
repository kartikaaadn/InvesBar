<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Assetify</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('Photo/bg_login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Pengaturan kontainer form yang lebih ringkas */
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1.5rem 2rem; /* Padding atas-bawah dikurangi */
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 360px; /* Lebar form dikecilkan */
            margin: 1rem;
            /* Aturan max-height dan overflow dihapus sesuai permintaan */
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem; 
        }

        .logo-container img {
            width: 180px; /* Ukuran logo dikecilkan */
            height: auto;
            margin-bottom: 0.5rem;
        }

        .welcome-title {
            font-size: 0.9rem; /* Font dikecilkan */
            font-weight: 400;
            color: #777;
            margin-bottom: 1.5rem; 
        }

        .form-group {
            margin-bottom: 0.85rem; /* Jarak antar input dipadatkan */
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.4rem;
            font-size: 0.9rem; /* Font label dikecilkan */
        }
        
        .password-error {
            color: #d93025;
            font-size: 0.75rem; /* Font dikecilkan */
            margin-top: 4px;
            display: none;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem 0.75rem; /* Padding input dikecilkan */
            border: 1px solid #dddfe2;
            border-radius: 6px;
            font-size: 0.9rem; /* Font input dikecilkan */
            font-family: 'Poppins', sans-serif;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .form-group input:focus {
            outline: none;
            border-color: #FFBAED;
            box-shadow: 0 0 0 2px #ffccf6;
        }

        .btn {
            width: 100%;
            padding: 0.7rem; /* Padding tombol dikecilkan */
            border: none;
            border-radius: 6px;
            font-size: 1rem; /* Font tombol dikecilkan */
            font-weight: 600;
            margin-top: 1rem; 
            transition: background-color 0.2s;
            background-color: #e0e0e0;
            color: #a0a0a0;
            cursor: not-allowed;
        }

        .btn.enabled {
            background-color: #FFBAED;
            color: #333;
            cursor: pointer;
        }
        
        .btn.enabled:hover {
            background-color: #f7aee0;
        }

        .form-switch {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.85rem; /* Font dikecilkan */
        }

        .form-switch a {
            color: #E1A0CB;
            text-decoration: none;
            font-weight: 500;
        }

        .form-switch a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="/proses-register" method="POST">
            <div class="form-header">
                <div class="logo-container">
                    <img src="Photo/logo.png" alt="Logo Assetify">
                </div>
                <p class="welcome-title">Buat Akun Baru</p>
            </div>
            <div class="form-group">
                <label for="namaLengkap">Nama Lengkap</label>
                <input type="text" id="namaLengkap" name="namaLengkap" placeholder="Masukkan nama lengkap Anda" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Buat username Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Buat password Anda" required>
            </div>
            <div class="form-group">
                <label for="konfirmasiPassword">Konfirmasi Password</label>
                <input type="password" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Ulangi password Anda" required>
                <p id="passwordError" class="password-error">Password tidak cocok.</p>
            </div>
            <button type="submit" id="registerButton" class="btn" disabled>Register</button>
            <p class="form-switch">
                Sudah punya akun? <a href="login.html">Login di sini</a>
            </p>
        </form>
    </div>
    <script>
        const namaLengkapInput = document.getElementById('namaLengkap');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const konfirmasiPasswordInput = document.getElementById('konfirmasiPassword');
        const registerButton = document.getElementById('registerButton');
        const passwordError = document.getElementById('passwordError');
        function checkFormState() {
            const isNamaFilled = namaLengkapInput.value.trim() !== '';
            const isUsernameFilled = usernameInput.value.trim() !== '';
            const isPasswordFilled = passwordInput.value.trim() !== '';
            const doPasswordsMatch = passwordInput.value === konfirmasiPasswordInput.value;
            if (isPasswordFilled && konfirmasiPasswordInput.value.trim() !== '' && !doPasswordsMatch) {
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
            if (isNamaFilled && isUsernameFilled && isPasswordFilled && doPasswordsMatch && konfirmasiPasswordInput.value.trim() !== '') {
                registerButton.disabled = false;
                registerButton.classList.add('enabled');
            } else {
                registerButton.disabled = true;
                registerButton.classList.remove('enabled');
            }
        }
        namaLengkapInput.addEventListener('input', checkFormState);
        usernameInput.addEventListener('input', checkFormState);
        passwordInput.addEventListener('input', checkFormState);
        konfirmasiPasswordInput.addEventListener('input', checkFormState);
    </script>
</body>
</html>