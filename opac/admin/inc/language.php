<?php
    include('../config/app.php');
    if(isset($_POST['lang_id'])){
        extract($_REQUEST);
        $select_language = $conn->query("SELECT * FROM settings_language WHERE lang_id = $default_language")->fetch_assoc();
        session_start();



        $_SESSION['default_language'] = $lang_id;
        $default_language =  $_SESSION['default_language'];
        // echo $default_language;
        $data['status'] = 200;
        echo json_encode($data);
    
    }

?>