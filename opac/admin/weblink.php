<?php
include('../config/app.php');
include('inc/access.php');







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Web Links</title>
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
    <style>
        img {
            max-width: 180px;
        }
    </style>
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
            <h1>Web Link</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $admin_url ?>">Home</a></li>
                    <li class="breadcrumb-item">Web Link</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <?php

            if ($page == "list") {
                $sql = "SELECT * FROM `web_link`";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
            ?>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List Web link <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>weblink/new">Add Link</a></h5>
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Cover</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Creator</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($num > 0) {
                                            error_reporting(E_ALL);
                                            while ($list = $qry->fetch_array()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?= $sn ?></th>
                                                    <td>
                                                        <img src="<?= $base_url . $list['path']; ?>" alt="" class="publisher_id" width="150">
                                                    </td>
                                                    <td><?= $list['link']; ?></td>
                                                    <td><?= $list['created_at']; ?></td>
                                                    <td><?php echo Creator($conn, $list['creator_id']) ?></td>
                                                    <td>
                                                        <?php
                                                        if ($list['status'] == 1) {
                                                            echo '<a class="btn btn-sm btn-success" href="' . $admin_url . 'weblink/status/' . $list['wl_id'] . '/0"><i class="ri-eye-fill"></i></a>';
                                                        } else {
                                                            echo '<a class="btn btn-sm btn-danger" href="' . $admin_url . 'weblink/status/' . $list['wl_id'] . '/1"><i class="ri-eye-off-fill"></i></a>';
                                                        }
                                                        ?>
                                                        

                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteView<?= $list['wl_id'] ?>">
                                                            <i class="ri-delete-bin-2-fill"></i>
                                                        </button>
                                                        <div class="modal fade" id="deleteView<?= $list['wl_id'] ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"><?= $list['link']; ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to delete <b><?= $list['link']; ?></b> </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <a href="<?= $admin_url . 'weblink/delete/' . $list['wl_id'] ?>" class="btn btn-danger">Yes Delete</a>
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
                if (isset($_POST['newLink'])) {
                    extract($_REQUEST);
                    error_reporting(E_ALL);
                    // cover image
                    $cover = uniqid() . $_FILES['path']['name'];
                    $cover_temp = $_FILES['path']['tmp_name'];
                    $cover_upload = "../uploads/weblink/" . $cover;
                    $cover = "uploads/weblink/" . $cover;
                    if (move_uploaded_file($cover_temp, $cover_upload)) {
                            $link = $conn->real_escape_string($_POST['link']);
                            $sql = "INSERT INTO `web_link` ( `link`,`path`, `status`, `created_at`, `creator_id`) VALUES ('$link', '$cover', 1, '$dateTime', '$user_id')";
                            if ($conn->query($sql)) {
                                echo redirect($admin_url . 'weblink/list');
                            }
                    }
                    // end cover image
                }
                // end insert 
            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Link</h5>
                                <!-- Custom Styled Validation -->
                                <form class="g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="link" class="col-sm-2 col-form-label text-end">Link</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="link" required name="link">
                                        </div>
                                    </div>
                                   
                                    <div class="row mb-3">
                                        <label for="path" class="col-sm-2 col-form-label text-end">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="path" required name="path" accept=".png, .jpeg" onchange="readURL(this);">
                                        </div>
                                    </div>
                                  

                                    <div class="col-12">
                                        <button class="btn btn-primary" name="newLink" type="submit">Add Book</button>
                                    </div>
                                </form>
                                <!-- End Custom Styled Validation -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } elseif ($page == 'status') {
                extract($_REQUEST);
                $sql = "UPDATE `web_link` SET `status` = '$status' WHERE `wl_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . "weblink/list");
                }
            } elseif ($page == 'delete') {
                // echo '23423';
                extract($_REQUEST);
                $sql = "SELECT * FROM `web_link` WHERE wl_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                $delete_weblink = $qry->fetch_assoc();
                unlink('../' . $delete_weblink['path']);
                // echo '<img src="'.'../../../'.$delete_weblink['path'].'">';
                $sql = "DELETE FROM `web_link` WHERE `wl_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . "weblink/list");
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>