<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Guidance Counseling System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #a3cef1, #f9f9f9);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #ffffff;
            border-radius: 20px;
            padding: 50px 60px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 28px;
            color: #004b87;
            margin-bottom: 15px;
        }

        .welcome {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .role {
            background: #004b87;
            color: white;
            display: inline-block;
            padding: 8px 18px;
            border-radius: 50px;
            margin-bottom: 30px;
            font-weight: 500;
        }

        a.logout {
            display: inline-block;
            background: #ff4b4b;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        a.logout:hover {
            background: #e13a3a;
            transform: translateY(-2px);
        }

        footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Guidance Counseling System 🎓</h1>
        <p class="welcome">Hello, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
        <p class="role"><?php echo $_SESSION['role']; ?></p>
       <a href="../logout.php" class="logout">Logout</a>
        <footer>© 2025 Bukidnon State University | Guidance Office</footer>
    </div>
</body>
</html>
