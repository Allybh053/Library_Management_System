<?php

include('config/app.php');
include('inc/publish.php');
error_reporting(0);
$BrochureLibrary =  $conn->query("SELECT * FROM settings_library_activity ORDER BY ac_id DESC")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPAC</title>
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- End Bootstrap -->
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End Style CSS -->
    <!-- lightbox CSS -->
    <link rel="stylesheet" href="./assets/css/lightbox/css/lightbox.min.css">

    <!-- End lightbox CSS --> <!-- Favicons -->
    <link href="<?= $favicon ?>" rel="icon">
</head>


<body>

    <?php include('inc/header.php'); ?>
    <main>
        <section class="home-section container-fluid my-2">
            <div class="row">
                <div class="bg-main-green col-md-8 col-sm-12 p-2 text-center">
                   
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <?php
                            
                            $qry = $conn->query("SELECT * FROM settings_slider LIMIT 1,6");
                            $num = $qry->num_rows;
                            if ($num > 0) {
                                $sn = 1;
                                while ($list = $qry->fetch_array()) {
                                ?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $sn ?>" aria-label="Slide <?php echo $sn ?>"></button>
                            <?php
                            $sn++;
                                }
                            }
                            ?>
                            <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
                        </div>
                        <div class="carousel-inner">
                        <?php
                            $qry = $conn->query("SELECT * FROM settings_slider LIMIT 1");
                            $num = $qry->num_rows;
                            if ($num > 0) {
                                while ($list = $qry->fetch_array()) {
                            ?>
                                    <div class="carousel-item active">
                                        <img src="<?= $list['image']; ?>" class="d-block w-100 radi-4 img-thumbnail" alt="...">
                                    </div>
                                <?php
                                }
                            }
                            $qry = $conn->query("SELECT * FROM settings_slider LIMIT 1,6");
                            $num = $qry->num_rows;
                            if ($num > 0) {
                                while ($list = $qry->fetch_array()) {
                                ?>
                                    <div class="carousel-item">
                                        <img src="<?= $list['image']; ?>" class="d-block w-100 radi-4 img-thumbnail" alt="...">
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="bg-main-green col-md-4 col-sm-12">
                    <ul class="d-flex flex-column mt-4">
                        <li class="list-group-item mx-1 mt-4"><a target="_blank" class="nav-link text-light text-center p-2 my-2 rounded-3 dhover" href="http://macclibrary.sprm.gov.my/index.html">
                                <h4>Koha</h4>
                            </a></li>
                        <li class="list-group-item mx-1"><a target="_blank" class="nav-link text-light text-center p-2 my-2 rounded-3 dhover" href="https://www.u-library.gov.my/portal/">
                                <h4>U-Pustaka</h4>
                            </a></li>
                        <li class="list-group-item mx-1"><a class="nav-link text-light text-center p-2 my-2 bg-dark rounded-3 dhover" href="e-book">
                                <h4>E-Book</h4>
                            </a></li>
                        <!-- <li class="list-group-item mx-1">
                            <div class="nav-link text-light text-center my-3 bg-darkrounded-3 dropdown">
                                <button class="btn dropdown-toggle p-1 w-100 dhover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <h4 class="text-light"><?= $lang['info_library']; ?></h4>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark w-100 ">
                                    <li class=""><a class="dropdown-item dhover" href="general-info"><?= $lang['general_info']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="library-activity"><?= $lang['library_activity']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="weblink"><?= $lang['web_link']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="brochure-library"><?= $lang['brochure_library']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="download">Download</a></li>
                                </ul>
                            </div>
                        </li> -->


                        <style>
                            .dropdown-toggle::after {
                                display: none;
                            }
                        </style>

                        <li class="list-group-item mx-1">
                            <div class="nav-link text-light text-center my-3 bg-darkrounded-3 dropdown">
                                <a class="btn dropdown-toggle p-1 w-100 dhover text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <h4 class="d-flex justify-content-between"><span></span><span class="text-center text-light"><?= $lang['info_library']; ?></span> <span class="text-end me-2"><i class="text-light fa-arrow-down"> &#9660;</i></span></h4>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark w-100 ">
                                    <li class=""><a class="dropdown-item dhover" href="general-info"><?= $lang['general_info']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="library-activity"><?= $lang['library_activity']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="weblink"><?= $lang['web_link']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="brochure-library"><?= $lang['brochure_library']; ?></a></li>
                                    <li><a class="dropdown-item dhover" href="download"><?= $lang['download']; ?></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- <section class="bg-light container-fluid my-2 pb-3">
            <h3 class="text-center py-3"><b><?= $lang['index_peraturan_perpustakaan']; ?></b></h3>
            <div class="row bg-main-green mx-2 py-2">
                <div class="col-md-4 home-rule">
                    <div class="m-2">
                        <a href="https://cdn.britannica.com/31/4031-004-82B0F3A9/Flag-Malaysia.jpg" data-lightbox="mygallery" data-title="<?= $lang['index_peraturan_perpustakaan']; ?>">
                            <img src="https://cdn.britannica.com/31/4031-004-82B0F3A9/Flag-Malaysia.jpg" class="radi-4" alt="" width="100%" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 home-rule">
                    <div class="m-2">
                        <a href="https://www.worldatlas.com/img/flag/ca-flag.jpg" data-lightbox="mygallery" data-title="<?= $lang['index_peraturan_perpustakaan']; ?>">
                            <img src="https://www.worldatlas.com/img/flag/ca-flag.jpg" class="radi-4" alt="" width="100%" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 home-rule">
                    <div class="m-2">
                        <a href="https://upload.wikimedia.org/wikipedia/en/thumb/4/41/Flag_of_India.svg/1200px-Flag_of_India.svg.png" data-lightbox="mygallery" data-title="<?= $lang['index_peraturan_perpustakaan']; ?>">
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/4/41/Flag_of_India.svg/1200px-Flag_of_India.svg.png" class="radi-4" alt="" width="100%" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </section> -->


        <section class="bg-light container-fluid my-2 pb-3">
            <h3 class="text-center py-3"><b><?= $lang['index_latest_e_book_collection']; ?></b></h3>

            <div class="d-flex flex-wrap justify-content-center gap-2 py-2">
                <?php
                $sql = "SELECT * FROM books ORDER BY book_id DESC LIMIT 6";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                if ($num > 0) {
                    while ($list = $qry->fetch_array()) {
                        include('inc/books/list.php');
                    }
                }
                ?>

            </div>
        </section>
        <section class="bg-light container-fluid my-2 pb-3">
            <h3 class="text-center py-3"><b><?= $lang['index_mengenai_kami']; ?></b></h3>
            <div class="d-flex justify-content-around">
                <div class="bg-main-green col mx-1 rounded-2 p-2 text-justify">
                    <?php
                    $about = $conn->query("SELECT * FROM settings_about")->fetch_assoc();
                    echo $about['description'];
                    ?>
                </div>
            </div>
        </section>
        <section class="bg-light container-fluid my-2">
            <div class="row p-3">
                <div class="col-md-15 rounded-2 p-1 text-center">
                    <div class="home-address maxv con">
                        <h3 class="pt-4"><?= $lang['index_waktu_perkhidmatan']; ?></h3>

                        <p>MONDAY - FRIDAY: 8.00AM - 5.00PM || SATURDAY, SUNDAY & PUBLIC HOLIDAYS: CLOSED</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('inc/footer.php'); ?>
    <!-- Jquery -->

    <!-- Bootstrap -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- lightbox CSS -->
    <script src="./assets/css/lightbox/js/lightbox-plus-jquery.min.js"></script>
    <!-- End lightbox CSS -->
</body>

</html>