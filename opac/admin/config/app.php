<?php
    session_start();
    include('Dblocal.php');
    include('Dbserver.php');
    include('localDomain.php');
    include('ServerDomain.php');
    include('Email.php');
   # 1 DATABASE CONNECT AND BASE URL
   if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.3.20')
   {
        $host       = Dblocal::LOCAL_HOST_NAME;
        $user       = Dblocal::LOCAL_HOST_USER;
        $pass       = Dblocal::LOCAL_HOST_PASSWORD;
        $dbname     = Dblocal::LOCAL_HOST_DATABASE;
        $base_url   = LocalDomain::LOCAL_DOMAIN;
        $admin_url  = LocalDomain::LOCAL_ADMIN_URL;
   }
   else
   {
        $host       = Dbserver::SERVER_HOST_NAME;
        $user       = Dbserver::SERVER_HOST_USER;
        $pass       = Dbserver::SERVER_HOST_PASSWORD;
        $dbname     = Dbserver::SERVER_HOST_DATABASE;
        $base_url   = serverDomain::SERVER_DOMAIN;
        $admin_url  = serverDomain::SERVER_ADMIN_URL;
   }
 

   $conn = new mysqli($host,$user,$pass,$dbname);
   if($conn->connect_error)
   {
    die('Connection Faild'.$conn->connect_error);
   }
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']))
    {
        $uri = 'https://';
    }
    else 
    {
        $uri = 'http://';
    }
    $uri            .= $_SERVER['HTTP_HOST'];
    $current_url    = $uri.$_SERVER['REQUEST_URI']; #current page url
    $get_ip         = $_SERVER['REMOTE_ADDR'];
    $email_host     = Email::EMAIL_HOST;
    $email_port     = Email::EMAIL_PORT;
    $email_title    = Email::EMAIL_TITLE;
    $email_username = Email::EMAIL_USERNAME;
    $email_password = Email::EMAIL_PASSWORD;
    $receive_email  = Email::EMAIL_FOR_RECEIVER;
    $action = '';
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
    }
    $page = '';
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    $slug = '';
    if(isset($_GET['slug']))
    {
        $slug = $_GET['slug'];
    }
    $dateTime       = date('Y-m-d H:i:s');
    $date           = date('Y-m-d');
    $month          = date('Y-m');
    $year           = date('Y');
    // session
    include('Session.php');
    // end session
    // custom and inc functions
    include('Custom.php');
    include('inc.php');
    $site_title     = Custom::SITE_TITLE;
    $paypalApi      = Custom::PAYPAL_API;
    $pageLimit      = Custom::PAGE_LIMIT;
    $admin_asset    = Custom::ADMIN_ASSET;
    $admin_asset    = $admin_url.$admin_asset;
    $sn             = 1;
    $favicon        = $base_url.Custom::favicon;
    $left_logo      = $base_url."assets/logo/maca.png";
    $right_logo      = $base_url."assets/logo/sprm.png";
    // end custom and inc functions
    error_reporting(0);
?>php?