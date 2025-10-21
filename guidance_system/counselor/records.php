<?php
session_start();
include('../config.php');

// ✅ Ensure only logged-in Counselors can access
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'Counselor') {
    header("Location: ../index.php");
    exit;
}

// ✅ Fetch all records
$query = "SELECT * FROM counseling_records ORDER BY date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Counseling Records | Guidance Counseling System</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    a {
      color: blue;
    }
  </style>
</head>
<body>
  <h2>Counseling Records</h2>
  <a href="dashboard.php">⬅ Back to Dashboard</a> | 
  <a href="../logout.php">Logout</a>

  <table>
    <tr>
      <th>Client Name</th>
      <th>Date</th>
      <th>Session Type</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['client_name']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['session_type']}</td>
                    <td>{$row['status']}</td>
                    <td>
                      <a href='view_record.php?id={$row['id']}'>View</a> | 
                      <a href='edit_record.php?id={$row['id']}'>Edit</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
