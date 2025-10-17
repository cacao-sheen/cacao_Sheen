<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$student = $student ?? [];
$errors  = $errors ?? [];

// ✅ Safe image check
$profilePath = '';
if (!empty($student['profile_pic'])) {
    $uploadPath = __DIR__ . '/../../uploads/' . $student['profile_pic']; 
    if (file_exists($uploadPath)) {
        $profilePath = base_url('uploads/' . htmlspecialchars($student['profile_pic']));
    }
}
if (empty($profilePath)) {
    $profilePath = base_url('assets/default.png');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🐾 Update Profile</title>
<style>
body {
    font-family: 'Comic Sans MS', cursive, sans-serif;
    background-color: #fff8f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
}
.cat {
    position: absolute;
    font-size: 40px;
    opacity: 0.8;
    animation: floatUp 12s linear infinite;
    pointer-events: none;
}
@keyframes floatUp {
    from { transform: translateY(100vh) rotate(0deg); opacity:0.7; }
    to { transform: translateY(-10vh) rotate(360deg); opacity:0; }
}
form {
    background-color: #fff0f5;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 350px;
    position: relative;
    z-index: 10;
    animation: popIn 0.8s ease;
}
@keyframes popIn { from {transform:scale(0.8);opacity:0;} to {transform:scale(1);opacity:1;} }
h2 {
    text-align: center; color: #ff69b4; margin-bottom: 20px;
    animation: bounce 1.5s infinite;
}
@keyframes bounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-5px);} }
label { display:block; margin-bottom:5px; color:#ff69b4; font-weight:bold; }
input[type="text"],input[type="email"],input[type="file"],input[type="password"]{
    width:100%;padding:12px;margin-bottom:20px;border:2px solid #ffb6c1;
    border-radius:10px;outline:none;transition:0.3s;
}
input:focus{border-color:#ff69b4;background-color:#ffe4e1;box-shadow:0 0 8px #ffb6c1;}
input[type="submit"]{
    width:100%;padding:12px;background-color:#ff69b4;border:none;
    border-radius:10px;color:white;font-weight:bold;cursor:pointer;transition:0.3s;
}
input[type="submit"]:hover{background-color:#ff1493;transform:scale(1.05);}
.actions{text-align:center;margin-top:20px;}
.back-link{
    display:inline-block;background-color:#ffe4e1;color:#ff69b4;font-weight:bold;
    text-decoration:none;padding:10px 18px;border-radius:20px;
    box-shadow:0 4px 8px rgba(0,0,0,0.15);transition:0.3s;
}
.back-link:hover{background-color:#ffb6c1;color:white;transform:scale(1.05) rotate(-2deg);}
.error-list{color:red;margin-bottom:20px;}
</style>
</head>
<body>

<!-- Floating cats -->
<div class="cat" style="left:5%; animation-duration: 12s;">🐱</div>
<div class="cat" style="left:25%; animation-duration: 15s;">😺</div>
<div class="cat" style="left:50%; animation-duration: 18s;">😸</div>
<div class="cat" style="left:70%; animation-duration: 16s;">😹</div>
<div class="cat" style="left:85%; animation-duration: 14s;">😻</div>

<?php if (!empty($errors)): ?>
<div class="error-list">
    <ul>
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?= site_url('/user_update/' . $student['id']); ?>" method="POST" enctype="multipart/form-data">
    <h2>Update My Profile 🌸</h2>

    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($student['first_name']); ?>" placeholder="First Name">

    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($student['last_name']); ?>" placeholder="Last Name">

    <label for="emails">Email</label>
    <input type="email" name="emails" id="emails" value="<?= htmlspecialchars($student['emails']); ?>" placeholder="Email">

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter new password (leave blank to keep current)">

    <div style="text-align:center; margin-bottom:15px;">
        <img src="<?= $profilePath ?>" alt="Profile" width="80" height="80" style="border-radius:50%; border:2px solid #ffb6c1;">
        <p style="color:#ff69b4; font-size:14px; margin-top:5px;">Current Profile Picture</p>
    </div>

    <label for="profile_pic">Change Profile Picture</label>
    <input type="file" name="profile_pic" id="profile_pic" accept="image/*">

    <input type="submit" value="Update ✨">

    <div class="actions">
        <a class="back-link" href="<?= site_url('user_panel'); ?>">⬅️ 🐱 Back to My Profile</a>
    </div>
</form>
</body>
</html>
