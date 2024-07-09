<?php
include('../config/app.php');
include('inc/access.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Settings</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="<?= $favicon ?>" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="<?= $admin_asset ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $admin_asset ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $admin_asset ?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= $admin_asset ?>vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= $admin_asset ?>vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= $admin_asset ?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= $admin_asset ?>vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="<?= $admin_asset ?>css/style.css" rel="stylesheet">
</head>

<body>
  <?php
  require_once('inc/header.php');
  ?>
  <?php
  include('inc/sidebar.php');
  ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $admin_url ?>">Home</a></li>
          <li class="breadcrumb-item">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
 
      
     sfa



    </section>

  </main>
  <!-- End #main -->
  <?php
  include('inc/footer.php')
  ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="<?= $admin_asset ?>vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= $admin_asset ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $admin_asset ?>vendor/chart.js/chart.umd.js"></script>
  <script src="<?= $admin_asset ?>vendor/echarts/echarts.min.js"></script>
  <script src="<?= $admin_asset ?>vendor/quill/quill.min.js"></script>
  <script src="<?= $admin_asset ?>vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= $admin_asset ?>vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= $admin_asset ?>vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="<?= $admin_asset ?>js/main.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
  <script>
    var allEditors = document.querySelectorAll('.text');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor.create(allEditors[i], {
        link: {
          addTargetToExternalLinks: true,
          decorators: [{
            mode: 'manual',
            label: 'Downloadable',
            attributes: {
              download: 'download'
            }
          }]
        },
        ckfinder: {
          uploadUrl: '<?= $admin_url ?>assets/ckeditor/upload.php'
        }
      });
    }
  </script>
</body>

</html>