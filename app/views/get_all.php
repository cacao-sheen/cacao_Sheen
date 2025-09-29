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

    .top-actions {
      display: flex;
      justify-content: space-between;  
      align-items: center;
      width: 80%;                 
      margin: 0 0 10px 0;         
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

    /* Search bar */
    .search-bar input {
      padding: 10px 15px;
      width: 250px;
      border: 2px solid #000;
      border-radius: 12px;
      font-family: 'Fredoka One', cursive, sans-serif;
      box-shadow: 4px 4px 0px #000000;
    }

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

    /* Pagination Styling */
    .pagination ul {
      list-style: none;   
      display: flex;
      gap: 8px;
      padding: 0;
      margin: 0;
    }

    .pagination li {
      list-style: none;
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

  <div class="top-actions">
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="🔍 Search student...">
    </div>
    <a href="<?= site_url('create') ?>">
      <button class="btn btn-add">+ Add Student</button>
    </a>
  </div>

  <table id="studentsTable">
    <tr>
      <th>Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
    <?php foreach($students as $students): ?>
      <tr>
        <td><?= $students['id']; ?></td>
        <td><?= $students['first_name']; ?></td>
        <td><?= $students['last_name']; ?></td>
        <td><?= $students['emails']; ?></td>
        <td>
          <a href="<?= site_url('/update/'.$students['id']); ?>">Update</a> | 
          <a href="<?= site_url('/delete/'.$students['id']); ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <div class="pagination">
    <?= isset($pagination_links) ? $pagination_links : '' ?>
  </div>

  <script>
   
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
