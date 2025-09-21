<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Form</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

    body {
      font-family: 'Fredoka One', cursive, sans-serif;
      background-image: url('https://wallpaperaccess.com/full/1543982.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    form {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px 50px;
      border-radius: 20px;
      border: 3px solid #000000;
      box-shadow: 6px 6px 0px #000000;
      width: 600px;
      position: relative;
    }

    form::before {
      content: "STUDENT";
      font-size: 26px;
      position: absolute;
      top: -25px;
      left: 50%;
      transform: translateX(-50%);
      background: #f4d03f;
      padding: 4px 18px;
      color: #000000;
      border: 3px solid #000;
      border-radius: 8px;
      font-weight: bold;
    }

    h2 {
      text-align: center;
      color: #000000;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      margin-bottom: 6px;   
      color: #250c93;
      font-weight: bold;
      font-size: 14px;
      text-align: left;
    }

    input[type="text"],
    input[type="email"] {
      width: 90%;
      padding: 12px;
      border: 2px solid #000000;
      border-radius: 10px;
      outline: none;
      background-color: #fff;
      transition: 0.3s;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
      border-color: #f4d03f;
      background-color: #fef9e7;
    }

    input[type="submit"] {
      width: 90%;
      padding: 14px;
      margin: 25px auto 0;
      background-color: #000000;
      border: none;
      border-radius: 10px;
      color: #ffffff;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      display: block;
    }

    input[type="submit"]:hover {
      background-color: #f4d03f;
      color: #000000;
      transform: scale(1.05);
    }

    .actions {
      text-align: center;
      margin-top: 20px;
    }

    .back-link {
      display: inline-block;
      padding: 10px 18px;
      border: 2px solid #000000;
      border-radius: 10px;
      text-decoration: none;
      color: #000000;
      background-color: #f4d03f;
      font-weight: bold;
      transition: 0.3s;
      box-shadow: 4px 4px 0px #000000;
    }

    .back-link:hover {
      background-color: #000000;
      color: #ffffff;
      transform: scale(1.05);
    }
</style>

</head>
<body>

<form action="<?=site_url('/create');?>" method="POST">
  <h2>Add Student</h2>

  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" placeholder="Your first name">
  </div>

  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" placeholder="Your last name">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="you@example.com">
  </div>

  <input type="submit" value="Submit">

  <div class="actions">
    <a class="back-link" href="<?=site_url('get_all')?>">⬅ Back to Students</a>
  </div>
</form>

</body>
</html>
