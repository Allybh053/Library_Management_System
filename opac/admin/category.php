<?php
include('../config/app.php');
include('inc/access.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Category</title>
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
      <h1>Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= $admin_url ?>">Home</a></li>
          <li class="breadcrumb-item">Category</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <?php

      if ($page == "list") {
        $sql = "SELECT * FROM `category`";
        $qry = $conn->query($sql);
        $num = $qry->num_rows;
      ?>
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Category <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>category/new">Create Category</a></h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Updated At</th>
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
                          <td><?= $list['category_name']; ?></td>
                          <td><?= $list['created_at']; ?></td>
                          <td><?= $list['updated_at']; ?></td>
                          <td><?php echo Creator($conn, $list['creator_id']) ?></td>
                          <td>
                            <?php
                            if ($list['status'] == 1) {
                              echo '<a class="btn btn-sm btn-success" href="'.$admin_url.'category/status/'.$list['category_id'].'/0"><i class="ri-eye-fill"></i></a>';
                            } else {
                              echo '<a class="btn btn-sm btn-danger" href="'.$admin_url.'category/status/'.$list['category_id'].'/1"><i class="ri-eye-off-fill"></i></a>';
                            }
                            ?>
                            <a class="btn btn-sm btn-warning" href="<?= $admin_url ?>category/update/<?= $list['category_id'] ?>"><i class="ri-pencil-fill"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteView<?= $list['category_id'] ?>">
                            <i class="ri-delete-bin-2-fill"></i>
                            </button>
                            <div class="modal fade" id="deleteView<?= $list['category_id'] ?>" tabindex="-1">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title"><?= $list['category_name']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                   <p>Do you want to delete <b><?= $list['category_name']; ?></b> </p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="<?= $admin_url.'category/delete/'.$list['category_id'] ?>" class="btn btn-danger">Yes Delete</a>
                                  </div>
                                </div>
                              </div>
                            </div><!-- End Large Modal-->
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
          $sql = "INSERT INTO `category` (`category_name`, `status`, `created_at`, `creator_id`) VALUES ('$category_name', 1, '$dateTime', '$user_id')";
          if ($conn->query($sql)) {
            echo redirect($admin_url . 'category/list');
          }
        }
        // end insert 
      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">New Category</h5>
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                  <div class="col-md-4">
                    <label for="category_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="category_name" required name="category_name">
                  </div>
                 
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

        $sql = "SELECT * FROM `category` WHERE category_id = $id";
        $qry = $conn->query($sql);
        $num = $qry->num_rows;
        if($num < 1){
          echo redirect($admin_url."category/list");
        }
        $edit = $qry->fetch_assoc();


        if(isset($_POST['updateUser'])){
          extract($_REQUEST);
          $sql = "UPDATE `category` SET category_name = '$category_name', updated_at = '$dateTime' WHERE `category_id` = $id";
          $qry = $conn->query($sql);
          if ($qry) {
           echo redirect($admin_url."category/list");
          }
        }
      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Update Category</h5>
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                  <div class="col-md-4">
                    <label for="category_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="category_name" required name="category_name" value="<?= $edit['category_name'] ?>">
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary" name="updateUser" type="submit">Update</button>
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
          $sql = "UPDATE `category` SET `status` = '$status' WHERE `category_id` = $id";
          $qry = $conn->query($sql);
          if ($qry) {
            $sql =  "UPDATE `books` SET `status` = '$status' WHERE `category_id` = $id";
            $qry = $conn->query($sql);
            if ($qry) {
            echo redirect($admin_url."category/list");
            }
          }
      }elseif($page == 'delete') {
        // echo '23423';
        extract($_REQUEST);
        $sql = "DELETE FROM `category` WHERE `category_id` = $id";
        $qry = $conn->query($sql);
        if ($qry) {

          $sql = "SELECT * FROM `books` WHERE category_id = $id";
          $qry = $conn->query($sql);
          $num = $qry->num_rows;
          while($delete_book = $qry->fetch_array()){
            unlink('../'.$delete_book['cover_image']);
            // echo '<img src="'.'../../../'.$delete_book['cover_image'].'">';
            
          }
          $sql = "DELETE FROM `books` WHERE `category_id` = $id";
          $qry = $conn->query($sql);
          if ($qry) {
          echo redirect($admin_url."category/list");
          }
        
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