<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$student = $student ?? [];
$errors  = $errors ?? [];

// ✅ Safe image path handling
$profilePath = '';
if (!empty($student['profile_pic'])) {
    $uploadPath = __DIR__ . '/../../uploads/' . basename($student['profile_pic']);
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
<title>🐶 Update Profile - Snoopy Style</title>
<style>
/* 🌈 Base Snoopy Theme */
body {
    font-family: 'Comic Sans MS', 'Poppins', sans-serif;
    background: linear-gradient(180deg, #b3d9ff 0%, #e6f2ff 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* 🧸 Form Container */
form {
    background: #fff;
    border: 3px solid #000;
    border-radius: 25px;
    box-shadow: 8px 8px 0 #000;
    width: 370px;
    padding: 35px 30px;
    position: relative;
    transition: 0.3s ease;
}
form:hover {
    transform: translateY(-2px);
}

/* 🏷️ Title */
h2 {
    text-align: center;
    color: #000;
    background: #fff;
    border: 3px solid #000;
    padding: 10px 20px;
    border-radius: 15px;
    display: block;
    width: fit-content;
    box-shadow: 4px 4px 0 #000;
    margin: 0 auto 25px;
}

/* 📋 Labels & Inputs */
label {
    display: block;
    font-weight: bold;
    color: #000;
    margin-bottom: 6px;
}
input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 2px solid #000;
    border-radius: 12px;
    margin-bottom: 18px;
    outline: none;
    transition: 0.2s;
    font-family: inherit;
}
input:focus {
    background: #e6f2ff;
    box-shadow: 3px 3px 0 #000;
}

/* 🐾 Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #000;
    color: #fff;
    font-weight: bold;
    border: 2px solid #000;
    border-radius: 15px;
    cursor: pointer;
    transition: 0.25s ease;
    box-shadow: 4px 4px 0 #000;
}
input[type="submit"]:hover {
    background: #0047ab;
    transform: translateY(-2px);
}

/* 🏡 Back Link */
.actions {
    text-align: center;
    margin-top: 15px;
}
.back-link {
    display: inline-block;
    background: #fff;
    color: #000;
    border: 2px solid #000;
    text-decoration: none;
    padding: 10px 16px;
    border-radius: 12px;
    box-shadow: 3px 3px 0 #000;
    font-weight: bold;
    transition: 0.25s;
}
.back-link:hover {
    background: #000;
    color: #fff;
}

/* 🖼️ Profile Preview */
.profile-preview {
    text-align: center;
    margin-bottom: 15px;
}
.profile-preview img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    border: 3px solid #000;
    object-fit: cover;
    box-shadow: 3px 3px 0 #000;
}

/* ❗ Error Box */
.error-list {
    background: #ffe6e6;
    border: 2px solid #ff0000;
    border-radius: 12px;
    padding: 10px;
    color: #b30000;
    margin-bottom: 15px;
    box-shadow: 3px 3px 0 #000;
}

/* 🐶 Snoopy Decoration */
.snoopy {
    position: absolute;
    bottom: -70px;
    right: -50px;
    width: 140px;
    opacity: 0.95;
}
</style>
</head>
<body>

<form action="<?= site_url('/user_update/' . ($student['id'] ?? '')); ?>" method="POST" enctype="multipart/form-data">
    <h2>🐾 Update Profile</h2>

    <?php if (!empty($errors)): ?>
    <div class="error-list">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name"
           value="<?= htmlspecialchars($student['first_name'] ?? ''); ?>" placeholder="Enter first name" required>

    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name"
           value="<?= htmlspecialchars($student['last_name'] ?? ''); ?>" placeholder="Enter last name" required>

    <label for="emails">Email</label>
    <input type="email" name="emails" id="emails"
           value="<?= htmlspecialchars($student['emails'] ?? ''); ?>" placeholder="Enter email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="New password (optional)">

    <div class="profile-preview">
        <img src="<?= $profilePath ?>" alt="Profile Picture">
        <p style="font-size:14px; color:#000;">Current Profile Picture</p>
    </div>

    <label for="profile_pic">Change Profile Picture</label>
    <input type="file" name="profile_pic" id="profile_pic" accept="image/*">

    <input type="submit" value="Update 🐶">

    <div class="actions">
        <a class="back-link" href="<?= site_url('user_panel'); ?>">⬅️ Back to My Profile</a>
    </div>

    <img src="https://i.imgur.com/ccSxqHh.png" alt="Snoopy" class="snoopy">
</form>

</body>
</html>
