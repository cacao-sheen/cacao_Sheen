<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🐾 Login Portal 🩷</title>
  <style>
    body {
      font-family: 'Comic Sans MS', cursive;
      background-color: #fff8f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      overflow: hidden;
    }

    /* Floating cats */
    .cat {
      position: absolute;
      font-size: 40px;
      opacity: 0.8;
      animation: floatUp 12s linear infinite;
      pointer-events: none;
    }
    @keyframes floatUp {
      from { transform: translateY(100vh) rotate(0deg); opacity: 0.7; }
      to { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
    }

    .login-box {
      background: #fff0f5;
      border-radius: 25px;
      padding: 35px;
      width: 340px;
      text-align: center;
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
      position: relative;
      z-index: 10;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    h2 {
      color: #ff69b4;
      margin-bottom: 20px;
      text-shadow: 1px 1px #ffe4e1;
    }

    input {
      width: 90%;
      padding: 12px;
      margin: 8px 0;
      border: 2px solid #ffb6c1;
      border-radius: 25px;
      outline: none;
      transition: 0.3s;
      font-size: 15px;
    }

    input:focus {
      border-color: #ff69b4;
      box-shadow: 0 0 10px rgba(255,105,180,0.4);
    }

    button {
      width: 100%;
      padding: 12px;
      background: #ffb6c1;
      color: white;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      margin-top: 10px;
    }
    button:hover {
      background: #ff69b4;
      transform: scale(1.05);
    }

    .toggle-link {
      margin-top: 15px;
      font-size: 13px;
      color: #ff69b4;
      cursor: pointer;
      text-decoration: underline;
      display: inline-block;
    }

    .error {
      color: red;
      margin: 10px 0;
      font-weight: bold;
    }

    /* Transition effects */
    .hidden {
      opacity: 0;
      transform: translateY(20px);
      pointer-events: none;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      transition: all 0.5s ease;
    }

    .active {
      opacity: 1;
      transform: translateY(0);
      pointer-events: all;
      position: relative;
      transition: all 0.5s ease;
    }
  </style>
</head>
<body>
  <!-- Floating cats -->
  <div class="cat" style="left:10%; animation-duration: 15s;">🐱</div>
  <div class="cat" style="left:30%; animation-duration: 18s;">😺</div>
  <div class="cat" style="left:50%; animation-duration: 12s;">😸</div>
  <div class="cat" style="left:70%; animation-duration: 20s;">😹</div>
  <div class="cat" style="left:85%; animation-duration: 14s;">😻</div>

  <div class="login-box">
    <!-- Admin Login -->
    <form id="adminForm" class="active" action="<?= site_url('/login') ?>" method="POST">
      <h2>🧑‍💼 Admin Login 🐾</h2>
      <?php if (!empty($admin_error)) : ?>
        <p class="error"><?= $admin_error ?></p>
      <?php endif; ?>
      <input type="text" name="username" placeholder="😺 Username" required>
      <input type="password" name="password" placeholder="🔒 Password" required>
      <button type="submit">✨ Login as Admin ✨</button>
      <div class="toggle-link" onclick="toggleForm('student')">🐾 Switch to Student Login 🐾</div>
    </form>

    <!-- Student Login -->
    <form id="studentForm" class="hidden" action="<?= site_url('/user_login') ?>" method="POST">
      <h2>🎓 Student Login 🐾</h2>
      <?php if (!empty($user_error)) : ?>
        <p class="error"><?= $user_error ?></p>
      <?php endif; ?>
      <input type="email" name="email" placeholder="📧 Email" required>
      <input type="password" name="password" placeholder="🔒 Password" required>
      <button type="submit">🐱 Login as Student 🐾</button>
      <p class="toggle-link">Don't have an account? 
         <a href="register" style="color:#ff69b4; text-decoration:underline;">Register here 🩷</a>
      </p>
      <div class="toggle-link" onclick="toggleForm('admin')">🧑‍💼 Switch to Admin Login 🧑‍💼</div>
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
