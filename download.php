<?php

include('config/app.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Section | OPAC</title>
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- End Bootstrap -->
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End Style CSS -->
    <script src="./assets/js/qrcode.min.js"></script>
    <!-- Favicons -->
    <link href="<?= $favicon ?>" rel="icon">
</head>

<body>
    <?php include('inc/header.php'); ?>
    <?php include('inc/nav.php'); ?>
    <main>
        <section class="bg-light container-fluid my-2 p-2">
            <h3 class="text-center mt-3"><?= $lang['download']; ?></h3>


            <style>

            </style>

            <div class="row p-3">
                <?php
                $sql = "SELECT * FROM settings_library_activity WHERE page = 'download' ORDER BY ac_id DESC";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                // echo $num;
                while ($list = $qry->fetch_array()) {
                ?>
                    <div class="col-lg-3 border border-warning-subtle p-2 text-center" style="height: 300px; max-height:auto">
                        <div class="card border-0">

                            <div class="card-body" style="height: 200px;">
                                <h6 id="qr_title_<?= $list['ac_id'] ?>"><?= $list['heading']; ?></h6><br>
                                <style>
                                    #qr_<?= $list['ac_id'] ?>img {
                                        height: 200px;
                                        width: 200px;
                                        margin: 0 auto;
                                    }
                                </style>
                                <div id="qr_<?= $list['ac_id'] ?>"></div>
                            </div>
                            <?php
                            if ($list['type'] == "file") {
                            ?>


                                <button class="btn btn-warning mt-5" id="file_<?= $list['ac_id'] ?>" onclick="qrcodeg(<?= $list['ac_id'] ?>,'<?= $base_url . $list['text']; ?>')">Show Qr Code</button>
                            <?php } else { ?>
                                <button class="btn btn-warning mt-5" onclick="openTab(<?= $list['ac_id'] ?>,'<?= $list['text']; ?>')">Open Link</button>
                            <?php } ?>
                        </div>
                    </div>
                <?php
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
    <script>
        function openTab(id, url) {
            window.open(url, "_blank");
        }

        function qrcodeg(id, url) {
            let qr;
            $("#file_" + id).hide();
            $("#qr_title_" + id).hide();
            qr = new QRCode(document.getElementById("qr_" + id), url);
            return qr;
        }
    </script>
</body>

</html>