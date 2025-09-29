
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

    body {
      font-family: 'Fredoka One', cursive, sans-serif;
      background: url('https://wallpaperaccess.com/full/1543982.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 60px 20px;
      color: #000;
    }

    /* ===== Card Container ===== */
    .form-card {
      background: #fff;
      border: 4px solid #000000;
      border-radius: 20px;
      padding: 30px 40px;
      width: 420px;
      box-shadow: 8px 8px 0px #000000;
      position: relative;
    }

    .form-card::before {
      content: "+ Add Student +";
      font-size: 20px;
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      background: #ffffff;
      padding: 6px 18px;
      color: #000000;
      border-radius: 12px;
      border: 3px solid #000000;
      box-shadow: 4px 4px 0px #000000;
    }

    h2 {
      text-align: center;
      font-size: 22px;
      margin-bottom: 20px;
      color: #000;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #000;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 2px solid #000000;
      border-radius: 12px;
      font-size: 14px;
      outline: none;
      font-family: 'Fredoka One', cursive, sans-serif;
      box-shadow: 4px 4px 0px #000000;
      background: #fef9e7;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="file"]:focus {
      background: #fff9c4;
      border-color: #f4d03f;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #000000;
      color: #ffffff;
      font-size: 16px;
      border: 2px solid #000000;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 4px 4px 0px #000000;
    }

    input[type="submit"]:hover {
      background-color: #f4d03f;
      color: #000;
      transform: scale(1.05);
    }

    /* Error box */
    .error {
      background: #ffcccc;
      border: 2px solid #000;
      border-radius: 12px;
      padding: 10px 15px;
      margin-bottom: 15px;
      box-shadow: 4px 4px 0px #000000;
      color: #000;
    }
    .error ul { margin: 0; padding-left: 20px; }

    /* Back button */
    .back-link {
      display: inline-block;
      margin-top: 15px;
      background: #000000;
      color: #fff;
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 12px;
      border: 2px solid #000000;
      transition: 0.3s;
      box-shadow: 4px 4px 0px #000000;
    }

    .back-link:hover {
      background: #f4d03f;
      color: #000;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <div class="form-card">
    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="<?=site_url('/create');?>" method="POST" enctype="multipart/form-data">
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" placeholder="Enter first name">

      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" placeholder="Enter last name">

      <label for="emails">Email</label>
      <input type="email" id="emails" name="emails" placeholder="you@example.com">

      <label for="profile_pic">Upload File</label>
      <input type="file" id="profile_pic" name="profile_pic" accept="image/*">

      <input type="submit" value="Submit">

      <div style="text-align:center;">
        <a class="back-link" href="<?=site_url('get_all')?>">← Back to Students</a>
      </div>
    </form>
  </div>

</body>
</html>

