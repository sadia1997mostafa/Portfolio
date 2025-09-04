<?php
session_start();
session_unset();
session_destroy();

// Delete the cookie
setcookie('admin_email', '', time() - 3600, "/");

header("Location: login.php");
exit();
?>
