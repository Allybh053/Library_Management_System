<?php
include('../config/app.php');
include('inc/access.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Users</title>
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
      <h1>Create New User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $admin_url ?>">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <?php

      if ($page == "list") {
        $sql = "SELECT * FROM `user`";
        $qry = $conn->query($sql);
        $num = $qry->num_rows;



        // if ($action == 'status') {
        //   echo 12;
        //   extract($_REQUEST);
        //   $sql = "UPDATE `user` SET `status` = '$status' WHERE `user_id` = $status_id";
        //   $qry = $conn->query($sql);
        //   if ($qry) {
        //    echo redirect($admin_url."users/list");
        //   }
        // }
      ?>
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Users <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>users/new">Create User</a></h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Login Id</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Creator</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($num > 0) {
                      while ($list = $qry->fetch_array()) {
                    ?>
                        <tr>
                          <th scope="row"><?= $sn ?></th>
                          <td><?= $list['name']; ?></td>
                          <td><?= $list['username']; ?></td>
                          <td><?= $list['created_at']; ?></td>
                          <td><?php echo Creator($conn, $list['creator_id']) ?></td>
                          <td>
                            <?php
                            if ($list['status'] == 1) {
                              echo '<a class="btn btn-sm btn-success" href="'.$admin_url.'users/status/'.$list['user_id'].'/0"><i class="ri-eye-fill"></i></a>';
                            } else {
                              echo '<a class="btn btn-sm btn-danger" href="'.$admin_url.'users/status/'.$list['user_id'].'/1"><i class="ri-eye-off-fill"></i></a>';
                            }
                            ?>
                            <a class="btn btn-sm btn-warning" href="<?= $admin_url ?>users/update/<?= $list['user_id'] ?>"><i class="ri-pencil-fill"></i></a>
                          </td>
                        </tr>
                    <?php
                    
                    $sn++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        </div>
      <?php
      } elseif ($page == "new") {
        if (isset($_POST['newUser'])) {
          extract($_REQUEST);
          $sql = "INSERT INTO `user` (`user_type`, `user_roll`, `name`, `username`, `password`, `email`, `status`, `created_at`, `creator_id`) VALUES ('admin', '$roll', '$name', '$username', '$password', '$email', 1, '$dateTime', '$user_id')";
          if ($conn->query($sql)) {
            echo redirect($admin_url . 'users/list');
          }
        }
        // end insert 
      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">New User</h5>
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                  <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="validationCustom01" required name="name">
                  </div>
                  <div class="col-md-4">
                    <label for="validationCustomUsername" class="form-label">Login ID</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required name="username">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">Pasword</label>
                    <input type="text" class="form-control" id="validationCustom02" required name="password">
                  </div>
                  <input type="hidden" name="roll">
                  <!-- <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Roll</label>
                    <select class="form-select" id="validationCustom04" required name="roll">
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div> -->
                  <div class="col-12">
                    <button class="btn btn-primary" name="newUser" type="submit">Create</button>
                  </div>
                </form>
                <!-- End Custom Styled Validation -->
              </div>
            </div>
          </div>
        </div>
      <?php
      } elseif ($page == "update") {
        extract($_REQUEST);

        $sql = "SELECT * FROM `user` WHERE user_id = $id";
        $qry = $conn->query($sql);
        $num = $qry->num_rows;
        if($num < 1){
          echo redirect($admin_url."users/list");
        }
        $edit = $qry->fetch_assoc();


        if(isset($_POST['updateUser'])){
          extract($_REQUEST);
          $sql = "UPDATE `user` SET name = '$name', username = '$username' WHERE `user_id` = $id";
          $qry = $conn->query($sql);
          if ($qry) {
           echo redirect($admin_url."users/list");
          }
        }
      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Update User</h5>
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                  <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="validationCustom01" required name="name" value="<?= $edit['name'] ?>">
                  </div>
                  <div class="col-md-4">
                    <label for="validationCustomUsername" class="form-label">Login ID</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required name="username" value="<?= $edit['username'] ?>">
                    </div>
                  </div>
                  <input type="hidden" name="roll">
                  <!-- <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Roll</label>
                    <select class="form-select" id="validationCustom04" required name="roll">
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div> -->
                  <div class="col-12">
                    <button class="btn btn-primary" name="updateUser" type="submit">Create</button>
                  </div>
                </form>
                <!-- End Custom Styled Validation -->
              </div>
            </div>
          </div>
        </div>
      <?php
      } elseif($page == 'status') {
          extract($_REQUEST);
          $sql = "UPDATE `user` SET `status` = '$status' WHERE `user_id` = $id";
          $qry = $conn->query($sql);
          if ($qry) {
           echo redirect($admin_url."users/list");
          }
      }
      ?>

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
</body>

</html>