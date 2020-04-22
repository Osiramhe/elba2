<?php
session_start();
unset($_SESSION['Adminid']);
session_destroy();

header("Location: login.php");
exit;
?>