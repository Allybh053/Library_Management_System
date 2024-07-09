<?php

// include('../config/app.php');
$qry = $conn->query("SELECT * FROM books WHERE status = 1");
$num = $qry->num_rows;
// echo $num;
if ($num == 0) 
{
    // echo  redirect($base_url,"under_construction.php");
    echo redirect($admin_url . '');
    // header('location:',$base_url."under_construction.php"); 
}

?>
