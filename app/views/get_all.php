<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: " . site_url('login'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>🐶 Snoopy Admin Dashboard</title>
<style>
body {
    font-family: 'Comic Sans MS', 'Poppins', sans-serif;
    background-color: #87b5f7;
    margin: 0;
    padding: 40px;
}
h1 {
    text-align: center;
    color: #000;
    background: #fff;
    border: 3px solid #000;
    display: inline-block;
    padding: 10px 25px;
    border-radius: 15px;
    box-shadow: 5px 5px 0 #000;
}
.container {
    background: #fff;
    border: 3px solid #000;
    border-radius: 20px;
    box-shadow: 8px 8px 0 #000;
    padding: 20px;
    margin: 30px auto;
    width: 95%;
    max-width: 1000px;
}
.top-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}
.btn {
    background: #000;
    color: #fff;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 3px 3px 0 #000;
    transition: 0.2s;
}
.btn:hover {
    transform: translateY(-2px);
}
.logout {
    background: #444;
}
input[type="text"] {
    padding: 8px;
    border: 2px solid #000;
    border-radius: 10px;
    outline: none;
    font-family: inherit;
}
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border: 2px solid #000;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 5px 5px 0 #000;
}
th, td {
    border: 2px solid #000;
    padding: 10px;
    text-align: center;
}
th {
    background: #f9f9f9;
    font-weight: bold;
}
tr:hover {
    background: #f0f8ff;
}
.profile {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 2px solid #000;
    object-fit: cover;
}

/* ✅ New clean Snoopy-style pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 25px;
    gap: 10px;
    flex-wrap: wrap;
}
.pagination a,
.pagination strong,
.pagination span {
    display: inline-block;
    padding: 8px 14px;
    border: 2px solid #000;
    background: #fff;
    color: #000;
    text-decoration: none;
    border-radius: 10px;
    box-shadow: 3px 3px 0 #000;
    font-weight: bold;
    transition: 0.2s;
}
.pagination a:hover {
    background: #000;
    color: #fff;
}
.pagination strong {
    background: #000;
    color: #fff;
}
.pagination span {
    display: none; /* removes the dots (...) */
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

<h1>🐾 Snoopy Admin Panel</h1>

<div class="container">
    <div class="top-bar">
        <div>
            <form class="search-bar" method="GET" action="<?= site_url('students/search') ?>" style="display:inline-block;">
                <input type="text" name="keyword" placeholder="🔍 Search students..." value="<?= htmlspecialchars($keyword ?? '') ?>">
                <button class="btn" type="submit">Search</button>
            </form>
            <a href="<?= site_url('create') ?>" class="btn">+ Add Student</a>
        </div>
        <a href="<?= site_url('logout') ?>" class="btn logout">Logout</a>
    </div>

    <table>
        <tr>
            <th>Photo</th>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php if (!empty($students)): ?>
            <?php foreach ($students as $student): ?>
                <?php
                    $profilePath = '';
                    if (!empty($student['profile_pic']) && file_exists(__DIR__ . '/../../uploads/' . $student['profile_pic'])) {
                        $profilePath = 'http://localhost/LavaLust-SCacao/uploads/' . htmlspecialchars($student['profile_pic']);
                    } else {
                        $profilePath = base_url('assets/default.png');
                    }
                ?>
                <tr>
                    <td><img src="<?= $profilePath ?>" class="profile" alt="Profile Picture"></td>
                    <td><?= htmlspecialchars($student['id']) ?></td>
                    <td><?= htmlspecialchars($student['first_name']) ?></td>
                    <td><?= htmlspecialchars($student['last_name']) ?></td>
                    <td><?= htmlspecialchars($student['emails']) ?></td>
                    <td>
                        <a href="<?= site_url('update/' . $student['id']) ?>" class="btn">✏️ Edit</a>
                        <a href="<?= site_url('delete/' . $student['id']) ?>" class="btn" style="background:#ff4747;" onclick="return confirm('Delete this student?');">🗑 Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No student records found 🐶</td></tr>
        <?php endif; ?>
    </table>

    <div class="pagination">
        <?= preg_replace('/<span class="dots">.*?<\/span>/', '', $pagination_links ?? '') ?>
    </div>
</div>

<img src="https://i.imgur.com/ccSxqHh.png" alt="Snoopy" class="footer-snoopy">

</body>
</html>
