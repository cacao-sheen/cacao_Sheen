<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🐾 Login Portal</title>
  <style>
    /* Global Reset */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(180deg, #dff4ff 0%, #ffffff 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      overflow: hidden;
      position: relative;
    }

    /* Soft floating clouds */
    .cloud {
      position: absolute;
      font-size: 48px;
      opacity: 0.3;
      animation: floatClouds 20s linear infinite;
      pointer-events: none;
    }
    @keyframes floatClouds {
      from { transform: translateX(-10vw); opacity: 0.4; }
      to { transform: translateX(110vw); opacity: 0.2; }
    }

    /* Login card */
    .login-box {
      background: #ffffff;
      border-radius: 25px;
      padding: 40px;
      width: 340px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(135, 206, 250, 0.4);
      position: relative;
      z-index: 10;
      animation: fadeIn 1s ease;
      border: 3px solid #bee9ff;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    /* Title */
    h2 {
      color: #3a8fd8;
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 22px;
      text-shadow: 1px 1px #e3f3ff;
    }

    /* Inputs */
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 2px solid #b8e0ff;
      border-radius: 15px;
      font-size: 15px;
      transition: 0.3s;
      background: #f8fcff;
    }

    input:focus {
      border-color: #6cbcff;
      box-shadow: 0 0 8px rgba(108,188,255,0.4);
      outline: none;
    }

    /* Button */
    button {
      width: 100%;
      padding: 12px;
      background: linear-gradient(90deg, #6cbcff, #3a8fd8);
      color: white;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      transition: 0.3s ease;
      margin-top: 10px;
    }
    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 12px rgba(108,188,255,0.5);
    }

    /* Toggle Links */
    .toggle-link {
      margin-top: 15px;
      font-size: 14px;
      color: #3a8fd8;
      cursor: pointer;
      display: inline-block;
      transition: 0.3s;
    }

    .toggle-link:hover {
      color: #1e6ab3;
      text-decoration: underline;
    }

    a {
      color: #3a8fd8;
      text-decoration: none;
      font-weight: 500;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Error */
    .error {
      color: #d33;
      margin: 10px 0;
      font-weight: 500;
      font-size: 14px;
    }

    /* Form transitions */
    .hidden {
      opacity: 0;
      transform: translateY(20px);
      pointer-events: none;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      transition: all 0.4s ease;
    }

    .active {
      opacity: 1;
      transform: translateY(0);
      pointer-events: all;
      position: relative;
      transition: all 0.4s ease;
    }

    /* Little Snoopy icon feel */
    .snoopy-icon {
      font-size: 48px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <!-- Floating clouds -->
  <div class="cloud" style="top:10%; left:5%; animation-duration: 22s;">☁️</div>
  <div class="cloud" style="top:20%; left:70%; animation-duration: 18s;">☁️</div>
  <div class="cloud" style="top:60%; left:30%; animation-duration: 25s;">☁️</div>
  <div class="cloud" style="top:75%; left:80%; animation-duration: 20s;">☁️</div>

  <div class="login-box">
    <div class="snoopy-icon"></div>
    <!-- Admin Login -->
    <form id="adminForm" class="active" action="<?= site_url('/login') ?>" method="POST">
      <h2>Admin Login</h2>
      <?php if (!empty($admin_error)) : ?>
        <p class="error"><?= $admin_error ?></p>
      <?php endif; ?>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login as Admin</button>
      <div class="toggle-link" onclick="toggleForm('student')">Switch to Student Login</div>
    </form>

    <!-- Student Login -->
    <form id="studentForm" class="hidden" action="<?= site_url('/user_login') ?>" method="POST">
      <h2>Student Login</h2>
      <?php if (!empty($user_error)) : ?>
        <p class="error"><?= $user_error ?></p>
      <?php endif; ?>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login as Student</button>
      <p class="toggle-link">
        Don’t have an account? <a href="register">Register here</a>
      </p>
      <div class="toggle-link" onclick="toggleForm('admin')">Back to Admin Login</div>
    </form>
  </div>

  <script>
    const adminForm = document.getElementById('adminForm');
    const studentForm = document.getElementById('studentForm');

    function toggleForm(target) {
      if (target === 'student') {
        adminForm.classList.remove('active');
        adminForm.classList.add('hidden');
        setTimeout(() => {
          studentForm.classList.remove('hidden');
          studentForm.classList.add('active');
        }, 200);
      } else {
        studentForm.classList.remove('active');
        studentForm.classList.add('hidden');
        setTimeout(() => {
          adminForm.classList.remove('hidden');
          adminForm.classList.add('active');
        }, 200);
      }
    }
  </script>
</body>
</html>
