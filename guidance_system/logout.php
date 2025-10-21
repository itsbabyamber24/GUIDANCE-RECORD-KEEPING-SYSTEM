<?php
session_start();

// Destroy session
session_unset();
session_destroy();

// Use full URL (not relative) to avoid XAMPP confusion
header("Location: http://localhost/guidance_system/index.php?message=loggedout");
exit();
?>
