<?php
session_start();
session_destroy(); // This ends the session completely
header("Location: login_page.php"); // Redirect to login page
exit();
?>
