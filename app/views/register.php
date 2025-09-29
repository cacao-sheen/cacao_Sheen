```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

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
      min-height: 100vh;
      padding: 40px;
    }

    .register-box {
      background: #fff;
      border: 4px solid #000;
      border-radius: 20px;
      box-shadow: 8px 8px 0px #000;
      width: 400px;
      padding: 35px 30px;
      text-align: center;
      position: relative;
    }

    .register-box::before {
      content: "+  Create Account  +";
      font-size: 18px;
      position: absolute;
      top: -28px;
      left: 50%;
      transform: translateX(-50%);
      background: #fff;
      padding: 6px 18px;
      border-radius: 12px;
      border: 3px solid #000;
      box-shadow: 3px 3px 0px #000;
      color: #000;
    }

    .register-box h2 {
      margin-bottom: 20px;
      font-size: 22px;
      color: #000;
    }

    label {
      display: block;
      text-align: left;
      font-size: 14px;
      margin: 10px 0 5px 3px;
      color: #000;
    }

    .register-box input {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 12px;
      border: 2px solid #000;
      border-radius: 12px;
      font-family: 'Fredoka One', cursive, sans-serif;
      font-size: 14px;
      box-shadow: 4px 4px 0px #000;
    }

    .register-box input:focus {
      outline: none;
      border-color: #f4d03f;
      background-color: #fef9e7;
    }

    .register-box button {
      width: 100%;
      padding: 12px 15px;
      margin-top: 10px;
      background: #000;
      color: #fff;
      font-size: 16px;
      border: 2px solid #000;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 4px 4px 0px #000;
      transition: 0.3s;
    }

    .register-box button:hover {
      background: #f4d03f;
      color: #000;
      transform: scale(1.05);
    }

    .register-box p {
      margin-top: 15px;
      font-size: 14px;
      color: #000;
    }

    .register-box a {
      color: #000;
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="register-box">
    <form method="POST" action="/index.php/register">
      <h2>Create Account</h2>

      <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
      <?php endif; ?>

      <label>Username</label>
      <input type="text" name="username" placeholder="Enter username" required>

      <label>Password</label>
      <input type="password" name="password" placeholder="Enter password" required>

      <label>Confirm Password</label>
      <input type="password" name="confirm_password" placeholder="Re-enter password" required>

      <button type="submit">Register</button>

      <p>Already have an account? <a href="/index.php/login">Login here</a></p>
    </form>
  </div>

</body>
</html>
```
