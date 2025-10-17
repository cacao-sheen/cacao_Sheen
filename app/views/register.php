<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🐶 Register Account</title>
<style>
  /* Base layout */
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
    overflow: hidden;
    margin: 0;
    position: relative;
  }

  /* Clouds floating around */
  .cloud {
    position: absolute;
    font-size: 48px;
    opacity: 0.3;
    animation: floatClouds 25s linear infinite;
    pointer-events: none;
  }

  @keyframes floatClouds {
    from { transform: translateX(-10vw); opacity: 0.4; }
    to { transform: translateX(110vw); opacity: 0.2; }
  }

  /* Register form container */
  form {
    background-color: #ffffff;
    padding: 35px;
    border-radius: 25px;
    box-shadow: 0 8px 25px rgba(135, 206, 250, 0.35);
    width: 360px;
    position: relative;
    z-index: 10;
    border: 3px solid #bee9ff;
    animation: fadeIn 0.8s ease;
  }

  @keyframes fadeIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }

  /* Header */
  h2 {
    text-align: center;
    color: #3a8fd8;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 22px;
    text-shadow: 1px 1px #e3f3ff;
  }

  .snoopy-icon {
    text-align: center;
    font-size: 48px;
    margin-bottom: 10px;
  }

  /* Labels & Inputs */
  label {
    display: block;
    margin-bottom: 6px;
    color: #3a8fd8;
    font-weight: 600;
    font-size: 14px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 18px;
    border: 2px solid #b8e0ff;
    border-radius: 12px;
    outline: none;
    font-size: 15px;
    background-color: #f8fcff;
    transition: 0.3s ease;
  }

  input:focus {
    border-color: #6cbcff;
    box-shadow: 0 0 8px rgba(108,188,255,0.4);
  }

  /* Submit button */
  input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: linear-gradient(90deg, #6cbcff, #3a8fd8);
    color: white;
    border: none;
    border-radius: 15px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s ease;
  }

  input[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(108,188,255,0.5);
  }

  /* Error messages */
  .errors {
    color: #d33;
    margin-bottom: 15px;
    background: #ffeaea;
    padding: 10px 15px;
    border-radius: 10px;
    font-size: 14px;
    list-style-type: none;
  }

  /* Back link */
  .actions {
    margin-top: 20px;
    text-align: center;
  }

  .back-link {
    display: inline-block;
    background: #e3f5ff;
    color: #3a8fd8;
    font-weight: 600;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 20px;
    transition: 0.3s;
    border: 2px solid #b8e0ff;
  }

  .back-link:hover {
    background: #6cbcff;
    color: white;
    transform: scale(1.05);
    box-shadow: 0 5px 12px rgba(108,188,255,0.4);
  }
</style>
</head>
<body>

<!-- Floating clouds background -->
<div class="cloud" style="top:10%; left:5%; animation-duration: 22s;">☁️</div>
<div class="cloud" style="top:25%; left:80%; animation-duration: 18s;">☁️</div>
<div class="cloud" style="top:55%; left:30%; animation-duration: 26s;">☁️</div>
<div class="cloud" style="top:75%; left:70%; animation-duration: 20s;">☁️</div>

<form action="<?= site_url('/register'); ?>" method="POST" enctype="multipart/form-data">
  <div class="snoopy-icon"></div>
  <h2>Register Account</h2>

  <?php if (!empty($errors)): ?>
    <ul class="errors">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <label for="first_name">First Name</label>
  <input type="text" id="first_name" name="first_name" placeholder="Your first name" required>

  <label for="last_name">Last Name</label>
  <input type="text" id="last_name" name="last_name" placeholder="Your last name" required>

  <label for="emails">Email</label>
  <input type="email" id="emails" name="emails" placeholder="you@example.com" required>

  <label for="password">Password</label>
  <input type="password" id="password" name="password" placeholder="Enter your password" required>

  <label for="profile_pic">Profile Picture</label>
  <input type="file" id="profile_pic" name="profile_pic">

  <input type="submit" value="Register 🩵">

  <div class="actions">
    <a class="back-link" href="<?= site_url('user_login') ?>">⬅️ Back to Login</a>
  </div>
</form>

</body>
</html>
