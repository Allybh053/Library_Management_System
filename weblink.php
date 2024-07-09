<?php

include('config/app.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Link | OPAC</title>
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- End Bootstrap -->
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End Style CSS -->  <!-- Favicons -->
  <link href="<?= $favicon ?>" rel="icon">
</head>

<body>
    <?php include('inc/header.php'); ?>
    <?php include('inc/nav.php'); ?>
    <main>
        <section class="bg-light container-fluid my-2 p-2">
            <div class="row">
                <div class="col-md-12 p-5 text-center">
                    <h3 class="text-center"><?= $lang['web_link']; ?></h3>
                   
                    <div class="d-flex align-items-center">
                        <?php
                            $sql = "SELECT * FROM web_link WHERE status = 1 ORDER BY wl_id DESC";
                            $qry = $conn->query($sql);
                            $num = $qry->num_rows;
                            if($num > 0){
                                while($list = $qry->fetch_array()){
                        ?>
                        <a target="_blank" href="<?= $list['link']; ?>" class="weblink-col p-3 d-flex align-items-center justify-content-center">
                            <div class="d-flex justify-content-center">
                                <img src="<?= $base_url.$list['path']; ?>" class="rounded mx-auto d-block" alt="Link">
                                <!-- <div class="card-body text-center align-self-end">
                                    <a target="_blank" class="btn btn-warning " href="<?= $list['link']; ?>">Visit This Link</a>
                                </div> -->
                            </div>
                        </a>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php include('inc/footer.php'); ?>

    <!-- Jquery -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/qrcode.min.js"></script>
    <!-- Bootstrap -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>