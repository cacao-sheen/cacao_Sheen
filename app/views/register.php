<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <style>
    /* Base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', Arial, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
      color: #fff;
    }

    /* Floating particles */
    .particle {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 215, 0, 0.08);
      animation: float 15s infinite ease-in-out;
    }
    .particle:nth-child(1) { width: 100px; height: 100px; top: 10%; left: 15%; }
    .particle:nth-child(2) { width: 150px; height: 150px; bottom: 15%; right: 20%; }
    .particle:nth-child(3) { width: 80px; height: 80px; top: 50%; right: 10%; }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(25px); }
    }

    /* Container */
    .register-container {
      position: relative;
      max-width: 450px;
      width: 100%;
      padding: 50px 40px;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    }

    h2 {
      font-size: 26px;
      color: #ffd700;
      text-align: center;
      margin-bottom: 10px;
    }

    .underline {
      width: 60px;
      height: 3px;
      background: #ffd700;
      margin: 0 auto 25px;
      border-radius: 2px;
    }

    label {
      font-size: 14px;
      font-weight: 500;
      color: rgba(255,255,255,0.9);
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 14px 16px;
      border: none;
      border-radius: 10px;
      background: rgba(255,255,255,0.15);
      color: #fff;
      font-size: 15px;
      outline: none;
      transition: all 0.3s;
    }
    input::placeholder {
      color: rgba(255,255,255,0.7);
    }
    input:focus {
      background: rgba(255,255,255,0.25);
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
    }

    button {
      width: 100%;
      padding: 14px;
      margin-top: 20px;
      background: linear-gradient(135deg, #ffd700, #ffa500);
      color: #1e1e1e;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    button:hover {
      background: linear-gradient(135deg, #ffbf00, #e69500);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(255, 215, 0, 0.3);
    }

    .error {
      color: #ff6b6b;
      text-align: center;
      margin-bottom: 15px;
      font-size: 14px;
    }

    p {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: rgba(255,255,255,0.8);
    }
    p a {
      color: #ffd700;
      font-weight: 600;
      text-decoration: none;
    }
    p a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

  <!-- Background particles -->
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>

  <div class="register-container">
    <form method="POST" action="/index.php/register">
      <h2>Create Account</h2>
      <div class="underline"></div>

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
