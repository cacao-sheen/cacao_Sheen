
<?php
// 🔒 Protect page: only logged in users can access
if (!isset($_SESSION['user_id'])) {
    header("Location: " . site_url('login'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Records</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

    body {
      font-family: 'Fredoka One', cursive, sans-serif;
      background: url('https://wallpaperaccess.com/full/1543982.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column; 
      gap: 20px; 
      min-height: 100vh;
      padding: 40px;
    }

    /* ===== Header ===== */
    .header {
      width: 96%;
      background: #000000;
      color: #ffffff;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.5);
    }

    .header h1 {
      margin: 0;
      font-size: 22px;
      letter-spacing: 1px;
    }

    .btn-logout {
      background-color: #f44336;
      color: #ffffff;
      font-family: 'Fredoka One', cursive, sans-serif;
      font-size: 14px;
      padding: 8px 16px;
      border: 2px solid #000000;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 4px 4px 0px #000000;
      margin-right: 20px; /* ✅ moves it slightly left */
    }

    .btn-logout:hover {
      background-color: #ffffff;
      color: #f44336;
      transform: scale(1.05);
    }

    /* ===== Top actions ===== */
    .top-actions {
      display: flex;
      justify-content: space-between;  
      align-items: center;
      width: 80%;                 
      margin: 80px 0 10px 0;  /* leave space for fixed header */       
    }

    .btn-add {
      background-color: #000000;
      color: #ffffff;
      font-family: 'Fredoka One', cursive, sans-serif;
      font-size: 14px;
      padding: 10px 18px;
      border: 2px solid #000000;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 4px 4px 0px #000000;
    }

    .btn-add:hover {
      background-color: #f4d03f;   
      color: #000000;
      transform: scale(1.05);
    }

    /* ===== Search bar ===== */
    .search-bar input {
      padding: 10px 15px;
      width: 250px;
      border: 2px solid #000;
      border-radius: 12px;
      font-family: 'Fredoka One', cursive, sans-serif;
      box-shadow: 4px 4px 0px #000000;
    }

    /* ===== Table ===== */
    table {
      border-collapse: collapse;
      margin: 0 auto;  
      font-family: 'Fredoka One', cursive, sans-serif;
      font-size: 16px;
      border: 4px solid #000000;
      border-radius: 20px;
      box-shadow: 8px 8px 0px #000000;
      background-color: #ffffff;
      width: 80%;
      position: relative;
    }

    table::before {
      content: "+  Student's Records  +";
      font-size: 18px;
      position: absolute;
      top: -30px; 
      left: 50%;
      transform: translateX(-50%);
      background: #ffffff;
      padding: 6px 16px;
      color: #000000;
      border-radius: 12px;
      border: 3px solid #000000;
      box-shadow: 3px 3px 0px #000000;
    }

    th, td {
      border: 2px solid #000000;
      padding: 14px 22px;
      text-align: center;
    }

    th {
      background-color: #f4d03f;
      color: #000000;
      font-weight: bold;
    }

    tr:nth-child(even) td {
      background-color: #fef9e7;
    }

    .profile-pic {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      overflow: hidden;
      border: 2px solid #000000;
    }
    .profile-pic img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* ===== Pagination ===== */
    .pagination ul {
      list-style: none;   
      display: flex;
      gap: 8px;
      padding: 0;
      margin: 20px 0;
    }

    .pagination a,
    .pagination strong,
    .pagination span {
      display: inline-block;
      padding: 10px 16px;
      border: 2px solid #000;
      border-radius: 10px;
      background-color: #fff;
      color: #000;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 4px 4px 0px #000000;
      transition: 0.2s ease-in-out;
    }

    .pagination a:hover {
      background-color: #f4d03f;
      transform: scale(1.05);
    }

    .pagination strong {
      background-color: #000;
      color: #fff;
      cursor: default;
    }

    .pagination span {
      background-color: #f0f0f0;
      color: #888;
      cursor: not-allowed;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <h1>Student Management System</h1>
    <a href="<?= site_url('logout'); ?>">
      <button class="btn-logout">Logout</button>
    </a>
  </div>

  <!-- Top actions -->
  <div class="top-actions">
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="🔍 Search student...">
    </div>
    <a href="<?= site_url('create') ?>">
      <button class="btn-add">+ Add Student</button>
    </a>
  </div>

  <!-- Table -->
  <table id="studentsTable">
    <tr>
      <th>Profile</th>
      <th>Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
    <?php foreach($students as $student): ?>
      <tr>
        <td>
          <div class="profile-pic">
            <?php if (!empty($student['profile_pic'])): ?>
              <img src="/upload/students/<?= $student['profile_pic'] ?>" alt="Profile">
            <?php else: ?>
              <img src="/upload/default.png" alt="No Profile">
            <?php endif; ?>
          </div>
        </td>
        <td><?= $student['id']; ?></td>
        <td><?= $student['first_name']; ?></td>
        <td><?= $student['last_name']; ?></td>
        <td><?= $student['emails']; ?></td>
        <td>
          <a href="<?= site_url('/update/'.$student['id']); ?>">Update</a> | 
          <a href="<?= site_url('/delete/'.$student['id']); ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <!-- Pagination -->
  <div class="pagination">
    <?= isset($pagination_links) ? $pagination_links : '' ?>
  </div>

  <script>
    // 🔍 Search filter
    document.getElementById('searchInput').addEventListener('keyup', function () {
      let filter = this.value.toLowerCase();
      let rows = document.querySelectorAll("#studentsTable tr:not(:first-child)");
      rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
      });
    });
  </script>

</body>
</html>

