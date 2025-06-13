<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Assetify</title>

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

    .form-container {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 1.5rem 2rem;
      border-radius: 15px;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 360px;
      margin: 1rem;
    }

    .form-header {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .logo-container img {
      width: 180px;
      height: auto;
      margin-bottom: 0.5rem;
    }

    .welcome-title {
      font-size: 0.9rem;
      font-weight: 400;
      color: #777;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 0.85rem;
    }

    .form-group label {
      display: block;
      font-weight: 500;
      margin-bottom: 0.4rem;
      font-size: 0.9rem;
    }

    .form-group input {
      width: 100%;
      padding: 0.6rem 0.75rem;
      border: 1px solid #dddfe2;
      border-radius: 6px;
      font-size: 0.9rem;
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
      padding: 0.7rem;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
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
      font-size: 0.85rem;
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
    <form id="loginForm">
      <div class="form-header">
        <div class="logo-container">
          <img src="Photo/logo.png" alt="Logo Assetify" />
        </div>
        <p class="welcome-title">Login untuk mulai</p>
      </div>
      <div class="form-group">
        <label for="username">Username atau Email</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username/email Anda" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required />
      </div>

      <button type="submit" id="loginButton" class="btn" disabled>Login</button>

      <p class="form-switch">
        Belum punya akun? <a href="register.html">Register</a>
      </p>
    </form>
  </div>

  <script>
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginButton = document.getElementById('loginButton');

    function checkFormState() {
      const isUsernameFilled = usernameInput.value.trim() !== '';
      const isPasswordFilled = passwordInput.value.trim() !== '';
      if (isUsernameFilled && isPasswordFilled) {
        loginButton.disabled = false;
        loginButton.classList.add('enabled');
      } else {
        loginButton.disabled = true;
        loginButton.classList.remove('enabled');
      }
    }

    usernameInput.addEventListener('input', checkFormState);
    passwordInput.addEventListener('input', checkFormState);

    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault(); // Mencegah reload halaman

      const username = usernameInput.value.trim();
      const password = passwordInput.value.trim();

      if (username === "admin" && password === "admin123") {
        window.location.href = "admin-dashboard.html";
      } else if (username === "user" && password === "user123") {
        window.location.href = "user-dashboard.html";
      } else {
        alert("Username atau password salah!");
      }
    });
  </script>
</body>

</html>
