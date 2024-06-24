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
    <!-- End Style CSS -->
      <!-- Favicons -->
  <link href="<?= $favicon ?>" rel="icon">
</head>

<body>
    <?php include('inc/header.php'); ?>
    <?php include('inc/nav.php'); ?>
    <main>
        <section class="bg-light container-fluid my-2 p-2">
            <h3 class="text-center mt-3"><?= $lang['general_info']; ?></h3>
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <!-- Timeline -->
                    <ul class="timeline">
                        <li class="timeline-item rounded ms-3 shadow d-flex flex-wrap justify-content-start ">
                            <img src="assets/g-info/1.jpg" alt="" class="col-md-3 rounded">
                            <div class="p-3 col-md-9">
                                <h4>Sejarah Perpustakaan</h4>
                                <p>Puan Hasni bekerja di MACA. agshfkf</p>
                            </div>
                        </li>
                       
                        <li class="timeline-item rounded ms-3 shadow d-flex flex-wrap justify-content-start ">
                            <img src="assets/g-info/2.jpg" alt="" class="col-md-3 rounded">
                            <div class="p-3 col-md-9">
                                <h4>Visi dan Misi</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod nostrum minima nesciunt esse? Aut atque sed, blanditiis vitae incidunt exercitationem placeat dolorum qui, minima consequuntur dolore eaque quis dolores minus!</p>
                            </div>
                        </li>
                       
                        <li class="timeline-item rounded ms-3 shadow d-flex flex-wrap justify-content-start ">
                            <img src="assets/g-info/3.jpg" alt="" class="col-md-3 rounded">
                            <div class="p-3 col-md-9">
                                <h4>Peraturan dan Panduan Perpustakaan</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod nostrum minima nesciunt esse? Aut atque sed, blanditiis vitae incidunt exercitationem placeat dolorum qui, minima consequuntur dolore eaque quis dolores minus!</p>
                            </div>
                        </li>
                       
                        <li class="timeline-item rounded ms-3 shadow d-flex flex-wrap justify-content-start ">
                            <img src="assets/g-info/4.jpg" alt="" class="col-md-3 rounded">
                            <div class="p-3 col-md-9">
                                <h4>Perkhidmatan Perpustakaan</h4>
                                <p>Perpustakaan Akademi Pencegahan Rasuah Malaysia menyediakan perkhidmatan rujukan, pinjaman . perkhidmatan pinjaman berkelompok (Inter library loan), perkhidmatan sumber elektronik, program galakan membaca, program literasi media dan maklumat , perkhidmatan fotokopi serta kerjasama dengan perpustakaan yang lain.</div>
                        </li>
                       
                        <li class="timeline-item rounded ms-3 shadow d-flex flex-wrap justify-content-start ">
                            <img src="assets/g-info/5.jpg" alt="" class="col-md-3 rounded">
                            <div class="p-3 col-md-9">
                                <h4>Kemudahan</h4>
                                <p>Pihak Perpustakaan telah menyediakan pelbagai kemudahan-kemudahan bagi tujuan keselesaan kepada pengguna perpustakaan. Diantara kemudahan yang disediakan adalah surau , lokar penyimpanan beg dan bilik mesyuarat , </div>
                        </li>
                       
                        <li class="timeline-item rounded ms-3 shadow d-flex flex-wrap justify-content-start ">
                            <img src="assets/g-info/6.jpg" alt="" class="col-md-3 rounded">
                            <div class="p-3 col-md-9">
                                <h4>Koleksi Bahan Bacaan</h4>
                                <p>Perpustakaan Akademik Pencegahan Rasuah Malaysia mempunyai koleksi bahan bacaan perpustakaan yang meliputi pelbagai kategori,seperti buku, majalah/jurnal, keratan akhbar, koleksi digital ,thesaurus, ensiklopedia, atlas dan tesis. Sehingga kini Perpustakaan Akademik Pencegahan Rasuah Malaysia mempunyai koleksi berjumlah melebihi empat ribu judul bahan bacaan mengenai rasuah, integriti, akauntabiliti dan pengurusan sama ada tempatan atau luar negara.</div>
                        </li>
                       
                       
                    </ul><!-- End -->

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