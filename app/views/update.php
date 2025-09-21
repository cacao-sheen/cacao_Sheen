<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Form</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

  body {
    font-family: 'Fredoka One', cursive, sans-serif;
    background: url('https://wallpaperaccess.com/full/1543982.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    gap: 40px;
    margin: 0;
  }

  form {
    background-color: #ffffffcc; /* white with transparency for contrast */
    padding: 40px;
    border-radius: 20px;
    border: 3px solid #000000;
    box-shadow: 6px 6px 0px #000000;
    width: 500px; /* main panel size */
    position: relative;
    overflow: hidden;
  }

  h2 {
    text-align: center;
    color: #000000;
    margin-bottom: 25px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: 120px 1fr;
    gap: 15px 20px;
    align-items: start; /* align labels on top */
  }

  label {
    color: #250c93ff;
    font-weight: bold;
    font-size: 14px;
    text-align: right;
    padding-top: 8px;
  }

  input[type="text"],
  input[type="email"] {
    width: 100%;
    max-width: 280px; /* prevent stretching */
    padding: 10px;
    border: 2px solid #000000;
    border-radius: 8px;
    outline: none;
    background-color: #fff;
    transition: 0.3s;
  }

  input[type="text"]:focus,
  input[type="email"]:focus {
    border-color: #f4d03f;
    background-color: #fef9e7;
  }

  input[type="submit"] {
    grid-column: 1 / span 2;
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    background-color: #000000;
    border: none;
    border-radius: 10px;
    color: #ffffff;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
  }

  input[type="submit"]:hover {
    background-color: #f4d03f;
    color: #000000;
    transform: scale(1.05);
  }

  .actions {
    margin-top: 20px;
    text-align: center;
    grid-column: 1 / span 2;
  }

  .actions a {
    color: #000000;
    font-weight: bold;
    text-decoration: none;
    padding: 10px 18px;
    border: 2px solid #000000;
    border-radius: 10px;
    background-color: #f4d03f;
    box-shadow: 3px 3px 0px #000000;
    transition: 0.3s;
  }

  .actions a:hover {
    background-color: #000000;
    color: #ffffff;
    transform: scale(1.05);
  }
</style>
</head>
<body>

<form action="<?=site_url('/update/'.segment(3));?>" method="POST">
  <h2>Update Student</h2>
  <div class="form-grid">
    <label for="id">ID</label>
    <input type="text" id="id" value="<?=$student['id'];?>" name="id" placeholder="Your ID">

    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" value="<?=$student['first_name'];?>" placeholder="Your first name">

    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" value="<?=$student['last_name'];?>" placeholder="Your last name">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?=$student['email'];?>" placeholder="you@example.com">

    <input type="submit" value="Submit">

    <div class="actions">
      <a href="<?=site_url('get_all')?>">⬅ Back to Students</a>
    </div>
  </div>
</form>

</body>
</html>
