<?php
session_start();
require_once "includes/db.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: staf/dashboard.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Sistem Inventaris</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-purple-200 via-pink-100 to-yellow-100 min-h-screen flex items-center justify-center">

  <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl px-8 py-10 w-full max-w-md">
    <h1 class="text-3xl font-extrabold text-center text-purple-700 mb-6 tracking-wide">Login Sistem Inventaris</h1>

    <?php if (isset($error)): ?>
      <div class="bg-red-200 text-red-800 px-4 py-2 mb-4 rounded text-sm shadow">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-gray-600 mb-1 text-sm">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border border-purple-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400 transition" />
      </div>

      <div>
        <label class="block text-gray-600 mb-1 text-sm">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border border-purple-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400 transition" />
      </div>

      <button type="submit" name="login" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-md font-medium transition duration-200">
        Masuk
      </button>
    </form>

    <p class="text-center text-xs text-gray-500 mt-6">© <?= date('Y') ?> Sistem Inventaris Kantor</p>
  </div>

</body>
</html>
