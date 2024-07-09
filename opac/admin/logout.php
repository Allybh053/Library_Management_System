<?php
include('../config/app.php');
session_start();
session_destroy();
unlink($_SESSION['user_id']);
$_SESSION['user_id'] = 0;
$user_id = 0;
header('location:'.$base_url);
?>