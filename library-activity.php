<?php

include('config/app.php');

$sql = "SELECT * FROM library_activity WHERE status = 1 ORDER BY id DESC";
$qry = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Activity | OPAC</title>
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- End Bootstrap -->
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/gallery/aos.css">
    <link rel="stylesheet" href="./assets/gallery/jquery-ui.css">
    <link rel="stylesheet" href="./assets/gallery/lightgallery.min.css">
    <link rel="stylesheet" href="./assets/gallery/magnific-popup.css">
    <link rel="stylesheet" href="./assets/gallery/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/gallery/owl.theme.default.min.css">
    <link rel="stylesheet" href="./assets/gallery/swiper.css">
    <!-- End Style CSS -->
    <script src="./assets/js/qrcode.min.js"></script>
    <!-- Favicons -->
    <link href="<?= $favicon ?>" rel="icon">
    <style>
       .item  img {
  width: 100%;
  height: auto;
  aspect-ratio: 16/9;
}
.item {
    cursor: pointer;
}

/* .lg-sub-html {
    top: 50px;
} */
    </style>
</head>

<body>
    <?php include('inc/header.php'); ?>
    <?php include('inc/nav.php'); ?>
    <main>
        <section class="container-fluid my-2 p-2 bg-light ">
            <h3 class="text-center mt-3"><?= $lang['library_activity']; ?></h3>


            <div class="row  d-flex justify-content-center gap-1 " id="lightgallery">

                <?php

                $qry = $conn->query("SELECT * FROM library_activity WHERE status = 1");
                $num = $qry->num_rows;
                if ($num > 0) {
                    while ($list = $qry->fetch_array()) {
                ?>

                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 item mb-2 p-2 activity-item" data-aos="fade" data-src="<?= $list['path']; ?>" data-sub-html="<h3><?php echo $list['title']; ?></h3><h5><?= $list['description']; ?></h5>">
                            <a href="#"><img src="<?= $list['path']; ?>" alt="<?= $list['title']; ?>" class="img-fluid"></a>
                            <h4 class="my-2"><?= $list['title']; ?></h4>
                            <p><?php echo  mb_strimwidth($list['description'], 0, 250, " <span class='text-primary text-decoration-underline'>See more</span>"); ?></p>
                        </div>

                <?php
                    }
                }
                ?>
            </div>








        </section>

    </main>
    <?php include('inc/footer.php'); ?>

    <!-- Jquery -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/qrcode.min.js"></script>
    <!-- Bootstrap -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/gallery/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/gallery/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="./assets/gallery/js/jquery-ui.js"></script>
    <script src="./assets/gallery/js/popper.min.js"></script>
    <script src="./assets/gallery/js/bootstrap.min.js"></script>
    <script src="./assets/gallery/js/owl.carousel.min.js"></script>
    <script src="./assets/gallery/js/jquery.stellar.min.js"></script>
    <script src="./assets/gallery/js/jquery.countdown.min.js"></script>
    <script src="./assets/gallery/js/jquery.magnific-popup.min.js"></script>
    <script src="./assets/gallery/js/bootstrap-datepicker.min.js"></script>
    <script src="./assets/gallery/js/swiper.min.js"></script>
    <script src="./assets/gallery/js/aos.js"></script>
    <script src="./assets/gallery/js/picturefill.min.js"></script>
    <script src="./assets/gallery/js/lightgallery-all.min.js"></script>
    <script src="./assets/gallery/js/jquery.mousewheel.min.js"></script>
    <script src="./assets/gallery/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#lightgallery').lightGallery();
        });
    </script>
</body>

</html>