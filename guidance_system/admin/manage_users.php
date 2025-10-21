<?php
session_start();
include('../config.php');

// Security check
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}

// ADD NEW COUNSELOR
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'Counselor';

    // Check for duplicate email or username
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR username='$username'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Error: Duplicate email or username!');</script>";
    } else {
        $query = "INSERT INTO users (username, password, role, email, status)
                  VALUES ('$username', '$password', '$role', '$email', 'active')";
        mysqli_query($conn, $query);
        echo "<script>alert('New Counselor added successfully!'); window.location='manage_users.php';</script>";
    }
}

// DEACTIVATE OR REACTIVATE
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'deactivate') {
        mysqli_query($conn, "UPDATE users SET status='inactive' WHERE id=$id");
        echo "<script>alert('Counselor account deactivated.'); window.location='manage_users.php';</script>";
    } elseif ($action == 'activate') {
        mysqli_query($conn, "UPDATE users SET status='active' WHERE id=$id");
        echo "<script>alert('Counselor account reactivated.'); window.location='manage_users.php';</script>";
    }
}

// FETCH COUNSELORS
$counselors = mysqli_query($conn, "SELECT * FROM users WHERE role='Counselor'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Counselors | Admin Panel</title>
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
        a.logout-btn {
            float: right;
            color: white;
            background: #ff3333;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        th {
            background: #0066cc;
            color: white;
        }
        .add-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .btn-deactivate { background: #e63946; }
        .btn-activate { background: #2a9d8f; }
        .btn-add { background: #264653; }
    </style>
</head>
<body>
<header>
    <h2>Manage Counselors</h2>
    <a href="../logout.php" class="logout-btn">Logout</a>
</header>

<div style="padding:20px;">
    <h3>Add New Counselor</h3>
    <form method="POST" class="add-form">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="add" class="btn btn-add">Add Counselor</button>
    </form>

    <h3>List of Counselors</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($counselors)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= ucfirst($row['status']) ?></td>
                <td>
                    <?php if ($row['status'] == 'active') { ?>
                        <a href="manage_users.php?action=deactivate&id=<?= $row['id'] ?>" class="btn btn-deactivate">Deactivate</a>
                    <?php } else { ?>
                        <a href="manage_users.php?action=activate&id=<?= $row['id'] ?>" class="btn btn-activate">Reactivate</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
