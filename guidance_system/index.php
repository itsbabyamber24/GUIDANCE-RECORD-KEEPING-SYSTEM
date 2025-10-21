<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Guidance Counseling System</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    /* 🌈 Background & layout */
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: linear-gradient(135deg, #74ABE2, #5563DE);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    /* 💎 Login container */
    form {
      background: #fff;
      padding: 40px 35px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      width: 350px;
      text-align: center;
      animation: fadeIn 0.6s ease-in-out;
    }

    /* ✨ Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* 🖋️ Title */
    h2 {
      margin-bottom: 20px;
      color: #333;
      font-size: 26px;
      letter-spacing: 1px;
    }

    /* 🧩 Inputs & select */
    input, select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    input:focus, select:focus {
      border-color: #5563DE;
      outline: none;
      box-shadow: 0 0 5px rgba(85, 99, 222, 0.5);
    }

    /* ✅ Button */
    button {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #6A5ACD, #483D8B);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      cursor: pointer;
      margin-top: 10px;
      transition: all 0.3s ease;
    }

    button:hover {
      background: linear-gradient(135deg, #5B4EC4, #3C2E8F);
      transform: translateY(-2px);
    }

    /* 🟢 Message styles */
    p {
      margin-top: 10px;
      font-size: 14px;
    }

    p[style*='green'] {
      color: #2E8B57 !important;
      font-weight: 600;
    }

    p[style*='red'] {
      color: #E53935 !important;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <form method="POST" action="">
    <h2>Login</h2>

    <?php
      // ✅ Logout success message
      if (isset($_GET['message']) && $_GET['message'] == 'loggedout') {
          echo "<p style='color:green;'>You have been logged out successfully.</p>";
      }
    ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <!-- ✅ Role selection -->
    <select name="role" required>
      <option value="">Select Role</option>
      <option value="Admin">Admin</option>
      <option value="Counselor">Counselor</option>
    </select>

    <button type="submit" name="login">Login</button>
  </form>

  <?php
    session_start();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role     = $_POST['role'];

        // ✅ Include role in query for safety
        $query  = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = $row['role'];

            if ($row['role'] == 'Admin') {
                header("Location: admin/dashboard.php");
            } elseif ($row['role'] == 'Counselor') {
                header("Location: counselor/dashboard.php");
            }
            exit;
        } else {
            echo "<p style='color:red;'>Invalid credentials or incorrect role!</p>";
        }
    }
  ?>

</body>
</html>
