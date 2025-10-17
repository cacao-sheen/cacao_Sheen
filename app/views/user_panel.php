<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: " . site_url('user_login'));
    exit;
}

$user = $user ?? null;

$profilePath = '';
if (!empty($user['profile_pic']) && file_exists(__DIR__ . '/../../uploads/' . $user['profile_pic'])) {
    $profilePath = 'http://localhost/LavaLust-SCacao/uploads/' . htmlspecialchars($user['profile_pic']);
} else {
    $profilePath = base_url('assets/default.png');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>🐾 My Snoopy Profile</title>
<style>
body {
    font-family: 'Comic Sans MS', 'Poppins', sans-serif;
    background-color: #87b5f7;
    text-align: center;
    padding: 60px;
}
.container {
    background: #fff;
    border: 3px solid #000;
    border-radius: 25px;
    box-shadow: 8px 8px 0 #000;
    display: inline-block;
    padding: 40px;
    width: 400px;
}
h1 {
    background: #fff;
    border: 3px solid #000;
    display: inline-block;
    padding: 10px 25px;
    border-radius: 15px;
    box-shadow: 4px 4px 0 #000;
    color: #000;
}
.profile-pic {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #000;
    margin: 20px 0;
}
.info {
    text-align: left;
    font-size: 16px;
    color: #000;
    margin-bottom: 20px;
}
.info strong {
    color: #1a1a1a;
}
.button {
    display: inline-block;
    padding: 10px 25px;
    background: #000;
    color: #fff;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 3px 3px 0 #000;
    margin-top: 10px;
    transition: 0.2s;
}
.button:hover {
    transform: translateY(-2px);
}
.footer-snoopy {
    position: fixed;
    bottom: 0;
    right: 40px;
    width: 200px;
}
</style>
</head>
<body>
    <h1>🐶 Welcome, <?= htmlspecialchars($user['first_name'] ?? 'Student') ?>!</h1>
    <div class="container">
        <img src="<?= $profilePath ?>" class="profile-pic" alt="Profile Picture">
        <div class="info">
            <p><strong>Full Name:</strong> <?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['emails'] ?? '') ?></p>
        </div>
        <a href="<?= site_url('user_update/' . $_SESSION['user_id']) ?>" class="button">✏️ Update Profile</a><br>
        <a href="<?= site_url('logout') ?>" class="button" style="background:#555;">🚪 Logout</a>
    </div>
    <img src="https://i.imgur.com/ccSxqHh.png" alt="Snoopy" class="footer-snoopy">
</body>
</html>
