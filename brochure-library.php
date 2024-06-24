<?php

include('config/app.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brochure Library | OPAC</title>
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
            <h3 class="text-center mt-3"><?= $lang['brochure_library']; ?></h3>
            <div class="row p-3">

                <div class="col-lg-10 mx-auto" style="height:1100px">
                <embed class="pdfobject" type="application/pdf" title="Embedded PDF" src="<?= $BrochureLibrary['text']; ?>#toolbar=0" style="overflow: auto; width: 100%; height: 800px;"></embed>
                    
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