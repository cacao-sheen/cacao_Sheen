```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

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

    .login-box {
      background: #fff;
      border: 4px solid #000;
      border-radius: 20px;
      box-shadow: 8px 8px 0px #000;
      width: 350px;
      padding: 30px 25px;
      text-align: center;
      position: relative;
    }

    .login-box::before {
      content: "+  Sign In  +";
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

    .login-box h2 {
      margin-bottom: 20px;
      font-size: 22px;
      color: #000;
    }

    .login-box input {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 2px solid #000;
      border-radius: 12px;
      font-family: 'Fredoka One', cursive, sans-serif;
      font-size: 14px;
      box-shadow: 4px 4px 0px #000;
    }

    .login-box input:focus {
      outline: none;
      border-color: #f4d03f;
      background-color: #fef9e7;
    }

    .login-box button {
      width: 100%;
      padding: 12px 15px;
      margin-top: 15px;
      background: #000;
      color: #fff;
      font-size: 16px;
      border: 2px solid #000;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 4px 4px 0px #000;
      transition: 0.3s;
    }

    .login-box button:hover {
      background: #f4d03f;
      color: #000;
      transform: scale(1.05);
    }

    .login-box p {
      margin-top: 15px;
      font-size: 14px;
      color: #000;
    }

    .login-box a {
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

  <div class="login-box">
    <form action="<?= site_url('login') ?>" method="POST">
      <h2>Welcome Back!</h2>

      <?php if (!empty($error)) : ?>
        <p class="error"><?= $error ?></p>
      <?php endif; ?>

      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>

      <p>Don't have an account? <a href="<?= site_url('register') ?>">Register here</a></p>
    </form>
  </div>

</body>
</html>
```
