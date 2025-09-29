<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
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

    /* Floating particles (subtle background animation) */
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
    .login-container {
      position: relative;
      display: flex;
      border-radius: 20px;
      overflow: hidden;
      max-width: 900px;
      width: 100%;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(12px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    }

    /* Left side: branding */
    .login-left {
      flex: 1;
      background: linear-gradient(135deg, #004080, #0066cc);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 50px 30px;
      color: #fff;
    }
    .login-left h1 {
      font-size: 36px;
      margin-bottom: 16px;
      letter-spacing: 1px;
    }
    .login-left p {
      font-size: 16px;
      max-width: 280px;
      text-align: center;
      line-height: 1.5;
    }

    /* Right side: login form */
    .login-right {
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(10px);
    }

    .login-right h2 {
      font-size: 26px;
      color: #ffd700;
      margin-bottom: 10px;
    }
    .login-right .underline {
      width: 60px;
      height: 3px;
      background: #ffd700;
      margin-bottom: 25px;
      border-radius: 2px;
    }

    .login-right input {
      width: 100%;
      padding: 14px 16px;
      margin-bottom: 18px;
      border: none;
      border-radius: 10px;
      background: rgba(255,255,255,0.15);
      color: #fff;
      font-size: 15px;
      outline: none;
      transition: 0.3s;
    }
    .login-right input::placeholder {
      color: rgba(255,255,255,0.7);
    }
    .login-right input:focus {
      background: rgba(255,255,255,0.25);
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
    }

    .login-right button {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #ffd700, #ffa500);
      color: #1e1e1e;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .login-right button:hover {
      background: linear-gradient(135deg, #ffbf00, #e69500);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(255, 215, 0, 0.3);
    }

    .login-right .error {
      color: #ff6b6b;
      margin-bottom: 12px;
      font-size: 14px;
    }

    .login-right p {
      margin-top: 18px;
      font-size: 14px;
      color: rgba(255,255,255,0.8);
      text-align: center;
    }
    .login-right a {
      color: #ffd700;
      font-weight: 600;
      text-decoration: none;
    }
    .login-right a:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        max-width: 400px;
      }
      .login-left {
        display: none;
      }
    }
  </style>
</head>
<body>

  <!-- Background particles -->
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>

  <div class="login-container">
    <!-- Left branding -->
    <div class="login-left">
      <h1>Welcome Back!</h1>
      <p>Sign in to access your professional dashboard and manage your account seamlessly.</p>
    </div>

    <!-- Right login form -->
    <div class="login-right">
      <form action="<?= site_url('login') ?>" method="POST">
        <h2>Sign In</h2>
        <div class="underline"></div>

        <?php if (!empty($error)) : ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>

        <p>Don't have an account? <a href="<?= site_url('register') ?>">Register here</a></p>
      </form>
    </div>
  </div>

</body>
</html>
