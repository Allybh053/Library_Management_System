<?php
session_start();
 error_reporting(E_ALL);

$sql = "SELECT * FROM user WHERE user_id = '$user_id'LIMIT 1";
$qry = $conn->query($sql);
$num = $qry->num_rows;
if($num > 0){
   $user = $qry->fetch_assoc();
}
else{
    header('location:'.$base_url.'login.php');
}

?>