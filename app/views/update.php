<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: " . site_url('login'));
    exit;
}

// ensure $student is set and is an array
$student = $student ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>✏️ Update Student</title>
<style>
    body { font-family:'Poppins',sans-serif; background:#f0f6ff; margin:0; padding:40px; }
    .card { max-width:600px; margin:0 auto; background:#fff; padding:26px; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.12); }
    h2 { text-align:center; margin-bottom:18px; }
    label { display:block; margin:10px 0 6px; font-weight:700; }
    input[type="text"], input[type="email"], input[type="file"] {
        width:100%; padding:10px 12px; border-radius:10px; border:1px solid #ccc; box-sizing:border-box;
    }
    .profile-preview { text-align:center; margin:18px 0; }
    .profile-preview img { width:120px; height:120px; border-radius:50%; border:3px solid #333; object-fit:cover; }
    .actions { text-align:center; margin-top:18px; }
    .btn { background:#222; color:#fff; padding:10px 18px; border-radius:10px; text-decoration:none; display:inline-block; }
    .btn.delete { background:#e74c3c; margin-left:10px; }
</style>
</head>
<body>
<div class="card">
    <h2>✏️ Update Student</h2>

    <?php if (empty($student) || !isset($student['id'])): ?>
        <p style="color:#c00; font-weight:700; text-align:center;">Student record not found.</p>
    <?php else: ?>
        <?php
            $id = (int)$student['id'];
            // determine profile URL
            $profile_url = site_url('assets/default.png');
            if (!empty($student['profile_pic'])) {
                $physical = __DIR__ . '/../../uploads/' . $student['profile_pic'];
                if (file_exists($physical)) $profile_url = site_url('uploads/' . rawurlencode($student['profile_pic']));
            }
        ?>

        <form action="<?= site_url('update/' . $id) ?>" method="POST" enctype="multipart/form-data">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($student['first_name'] ?? '') ?>">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($student['last_name'] ?? '') ?>">

            <label for="emails">Email</label>
            <input type="email" id="emails" name="emails" value="<?= htmlspecialchars($student['emails'] ?? '') ?>">

            <div class="profile-preview">
                <p style="margin:0 0 8px; font-weight:700;">Current Profile Picture</p>
                <img src="<?= $profile_url ?>" alt="Profile Preview">
            </div>

            <label for="profile_pic">Change Profile Picture</label>
            <input type="file" id="profile_pic" name="profile_pic" accept="image/*">

            <div class="actions">
                <button type="submit" class="btn">Update</button>
                <a href="<?= site_url('get_all') ?>" class="btn delete" style="background:#777;">Back</a>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
