<?php
include('config/app.php');
error_reporting(0);
extract($_REQUEST);
if (isset($_POST['login'])) {
  extract($_REQUEST);
  $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND status  = 1";
  $qry = $conn->query($sql);
  $num = $qry->num_rows;
  if ($num > 0) {
    $info = $qry->fetch_assoc();
    session_start();
    $_SESSION['username']       = $info['username'];
    $_SESSION['user_id']        = $info['user_id'];
    $_SESSION['email']          = $info['email'];
    $_SESSION['name']           = $info['name'];
    $_SESSION['user_roll']      = $info['user_roll'];

    header('location:' . $admin_url);
  } else {
    session_start();
    header('location:login?page=error');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= $favicon ?>" rel="icon">
  <link href="<?= $favicon ?>" rel="apple-touch-icon">

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

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<?= $base_url ?>" class="logo d-flex align-items-center w-auto">
                  <!-- <img src="<?= $admin_asset ?>img/logo.png" alt=""> -->
                  <span class="d-none d-lg-block"><?= $site_title ?> Login</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">

                    <?php
                    if ($page == 'error') {
                      echo '<div class="alert alert-danger">
                        <b>Invalid Username or Password</b>
                      </div>';
                    }
                    ?>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>
                    <br>
                  </form>

                </div>
              </div>

              <div class="credits">
                <div class="copyright">
                  &copy; Copyright <strong><span><?= $site_title ?></span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                  Designed by <a href="https://maskavia.com/portal/">Maskavia Sdn Bhd</a>
                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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

</body>

</html>