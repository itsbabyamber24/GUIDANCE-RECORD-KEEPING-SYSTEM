<?php
session_start();

// Clear session data
session_unset();
session_destroy();

// Redirect to your system’s index.php (with full folder path)
header("Location: /guidance_system/index.php?message=loggedout");
exit();
?>
