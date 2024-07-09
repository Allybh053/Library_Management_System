<?php


if(isset($_SESSION['user_id']))
{
    error_reporting(0);
    $username           = $_SESSION['username'];
    $user_id            = $_SESSION['user_id'];
    $user_email         = $_SESSION['email']; 
    $user_name          = $_SESSION['name']; 
    $user_roll          = $_SESSION['user_roll'];

} 
else 
{
    $username           = 0;
    $user_id            = 0;
    $user_email         = 0; 
    $user_name          = 0; 
    $user_roll          = 0;
}

if(isset($_SESSION['default_language'])){
    $default_language = $_SESSION['default_language'];
} 
else
{
    $select_language    = $conn->query("SELECT * FROM settings_language WHERE status = 1")->fetch_assoc();
    $default_language   = $select_language['lang_id'];
}



?>