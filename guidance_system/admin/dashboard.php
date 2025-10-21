<?php
session_start();
include('../config.php');

// Prevent access if not logged in or not admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}

// Get counts for dashboard summary
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$activeUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS active FROM users WHERE status='active'"))['active'];
$inactiveUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS inactive FROM users WHERE status='inactive'"))['inactive'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Guidance Counseling System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            margin: 0;
        }
        header {
            background: #0066cc;
            color: white;
            padding: 15px;
        }
        nav {
            background: #004080;
            padding: 10px;
        }
        nav a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
        }
        .container {
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            display: inline-block;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .logout-btn {
            float: right;
            color: white;
            background: #ff3333;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h2>Admin Dashboard</h2>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </header>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="reports.php">Reports</a>
        <a href="notifications.php">Notifications</a>
        <a href="settings.php">Settings</a>
    </nav>

    <div class="container">
        <h3>System Overview</h3>
        <div class="card">Total Users: <?php echo $totalUsers; ?></div>
        <div class="card">Active Users: <?php echo $activeUsers; ?></div>
        <div class="card">Inactive Users: <?php echo $inactiveUsers; ?></div>
    </div>
</body>
</html>
