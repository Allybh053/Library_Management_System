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
      <?php

      if ($page == "languagelist") {
        error_reporting(E_ALL);
        $sql = "SELECT * FROM `settings_language`";
        $qry = $conn->query($sql);
        $qry2 = $conn->query($sql);
        $num = $qry->num_rows;
      ?>
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Languages <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>settings/languagenew">Add New Language</a></h5>
                <!-- Table with stripped rows -->
                <div class="row mb-3">
                  <div class="col-md-12">
                    <div class="btn-group">
                      <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Default Language
                      </button>
                      <ul class="dropdown-menu">
                      <?php
                    if ($num > 0) {
                      while ($list = $qry2->fetch_array()) {
                    ?>
                        <li><a class="dropdown-item" href="<?= $admin_url.'settings/languagestatus/'.$list['lang_id'] ?>"><?= $list['lang_name']; ?></a></li>
                        <?php
                      }
                      }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Creator</th>
                      <th scope="col" class="text-center">Status</th>
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
                          <td><?= $list['lang_name']; ?></td>
                          <td><?php echo Creator($conn, $list['creator_id']) ?></td>
                          <td class="text-center">
                            <?php
                            if ($list['status'] == 1) {
                              echo '<span class="text-success font-weight-bold me-2"><i class="ri-eye-fill"></i></span>';
                            } else {
                              echo '<span class="text-danger" font-weight-bold me-2><i class="ri-eye-off-fill"></i></span>';
                            }
                            ?>
                          </td>
                          <td>

                            <a class="btn btn-sm btn-warning" href="<?= $admin_url ?>settings/languageupdate/<?= $list['lang_id'] ?>"><i class="ri-pencil-fill"></i></a>
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
      }elseif($page == 'languagestatus') {
        extract($_REQUEST);
      error_reporting(E_ALL);
        $qry0 = $conn->query("UPDATE `settings_language` SET `status` = 0");
        $sql = "UPDATE `settings_language` SET `status` = '1' WHERE `lang_id` = $id";
        $qry = $conn->query($sql);
        if($qry) {
         echo redirect($admin_url. 'settings/languagelist');
        }
    } elseif ($page == "languagenew") {

        if (isset($_POST['addNewLanguage'])) {
          extract($_REQUEST);
          $sql = "INSERT INTO `settings_language` (`lang_name`, `home`, `ebook`, `pustaka`, `info_library`, `general_info`, `library_activity`, `web_link`, `download`, `index_peraturan_perpustakaan`, `index_latest_e_book_collection`, `index_mengenai_kami`, `index_waktu_perkhidmatan`, `index_hubangi_kami`, `e_book_seach_by_title_isbn`, `e_book_select_category`, `e_book_select_author`, `e_book_select_publisher`, `e_book_sort_old`, `e_book_sort_new`, `detail_author`, `detail_category`, `detail_publisher`, `detail_published_date`, `detail_download_pdf`, `status`, `creator_id`) VALUES ('$lang_name', '$home', '$ebook', '$pustaka', '$info_library', '$general_info', '$library_activity', '$web_link', '$download', '$index_peraturan_perpustakaan', '$index_latest_e_book_collection', '$index_mengenai_kami', '$index_waktu_perkhidmatan', '$index_hubangi_kami', '$e_book_seach_by_title_isbn', '$e_book_select_category', '$e_book_select_author', '$e_book_select_publisher', '$e_book_sort_old', '$e_book_sort_new', '$detail_author', '$detail_category', '$detail_publisher', '$detail_published_date', '$detail_download_pdf', '1', '$user_id')";
          if ($conn->query($sql)) {
            echo redirect($admin_url . 'settings/languagelist');
          }
        }

      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add Language</h5>
                <!-- Custom Styled Validation -->
                <form class="g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                  <div class="row mb-2">
                    <label for="lang_name" class="form-label">Language Name</label>
                    <input type="text" class="form-control" id="lang_name" required name="lang_name">
                  </div>
                  <div class="row mb-2">
                    <label for="home" class="form-label">Home</label>
                    <input type="text" class="form-control" id="home" required name="home">
                  </div>
                  <div class="row mb-2">
                    <label for="ebook" class="form-label">Book</label>
                    <input type="text" class="form-control" id="ebook" required name="ebook">
                  </div>
                  <div class="row mb-2">
                    <label for="pustaka" class="form-label">U-Pustaka</label>
                    <input type="text" class="form-control" id="pustaka" required name="pustaka">
                  </div>
                  <div class="row mb-2">
                    <label for="info_library" class="form-label">Library</label>
                    <input type="text" class="form-control" id="info_library" required name="info_library">
                  </div>
                  <div class="row mb-2">
                    <label for="index_peraturan_perpustakaan" class="form-label">Library Rules</label>
                    <input type="text" class="form-control" id="index_peraturan_perpustakaan" required name="index_peraturan_perpustakaan">
                  </div>
                  <div class="row mb-2">
                    <label for="index_latest_e_book_collection" class="form-label">Latest E-Book Collection</label>
                    <input type="text" class="form-control" id="index_latest_e_book_collection" required name="index_latest_e_book_collection">
                  </div>
                  <div class="row mb-2">
                    <label for="index_mengenai_kami" class="form-label">About Us</label>
                    <input type="text" class="form-control" id="index_mengenai_kami" required name="index_mengenai_kami">
                  </div>
                  <div class="row mb-2">
                    <label for="index_waktu_perkhidmatan" class="form-label">Operation Hours</label>
                    <input type="text" class="form-control" id="index_waktu_perkhidmatan" required name="index_waktu_perkhidmatan">
                  </div>
                  <div class="row mb-2">
                    <label for="index_hubangi_kami" class="form-label">Contact Us</label>
                    <input type="text" class="form-control" id="index_hubangi_kami" required name="index_hubangi_kami">
                  </div>
                  <div class="row mb-2">
                    <label for="e_book_seach_by_title_isbn" class="form-label">Search by Title ISBN</label>
                    <input type="text" class="form-control" id="e_book_seach_by_title_isbn" required name="e_book_seach_by_title_isbn">
                  </div>
                  <div class="row mb-2">
                    <label for="e_book_select_category" class="form-label">Select Category</label>
                    <input type="text" class="form-control" id="e_book_select_category" required name="e_book_select_category">
                  </div>
                  <div class="row mb-2">
                    <label for="e_book_select_author" class="form-label">Select Author</label>
                    <input type="text" class="form-control" id="e_book_select_author" required name="e_book_select_author">
                  </div>
                  <div class="row mb-2">
                    <label for="e_book_select_publisher" class="form-label">Select Publisher</label>
                    <input type="text" class="form-control" id="e_book_select_publisher" required name="e_book_select_publisher">
                  </div>
                  <div class="row mb-2">
                    <label for="e_book_sort_old" class="form-label">Sort Old</label>
                    <input type="text" class="form-control" id="e_book_sort_old" required name="e_book_sort_old">
                  </div>
                  <div class="row mb-2">
                    <label for="e_book_sort_new" class="form-label">Sort New</label>
                    <input type="text" class="form-control" id="e_book_sort_new" required name="e_book_sort_new">
                  </div>
                  <div class="row mb-2">
                    <label for="detail_author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="detail_author" required name="detail_author">
                  </div>
                  <div class="row mb-2">
                    <label for="detail_category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="detail_category" required name="detail_category">
                  </div>
                  <div class="row mb-2">
                    <label for="detail_publisher" class="form-label">Category</label>
                    <input type="text" class="form-control" id="detail_publisher" required name="detail_publisher">
                  </div>
                  <div class="row mb-2">
                    <label for="detail_published_date" class="form-label">Published Date</label>
                    <input type="text" class="form-control" id="detail_published_date" required name="detail_published_date">
                  </div>
                  <div class="row mb-2">
                    <label for="detail_download_pdf" class="form-label">Download Pdf</label>
                    <input type="text" class="form-control" id="detail_download_pdf" required name="detail_download_pdf">
                  </div>
                  <div class="row mb-2">
                    <label for="general_info" class="form-label">General Info</label>
                    <input type="text" class="form-control" id="general_info" required name="general_info">
                  </div>
                  <div class="row mb-2">
                    <label for="library_activity" class="form-label">Library Activity</label>
                    <input type="text" class="form-control" id="library_activity" required name="library_activity">
                  </div>
                  <div class="row mb-2">
                    <label for="web_link" class="form-label">Web Link</label>
                    <input type="text" class="form-control" id="web_link" required name="web_link">
                  </div>
                  <div class="row mb-2">
                    <label for="download" class="form-label">Download</label>
                    <input type="text" class="form-control" id="download" required name="download">
                  </div>
                  <div classrow mb-2">
                    <button class="btn btn-primary" name="addNewLanguage" type="submit">Create</button>
                  </div>
                </form>
                <!-- End Custom Styled Validation -->
              </div>
            </div>
          </div>
        </div>
      <?php

      } elseif ($page == "about") {
        $check_about = $conn->query("SELECT * FROM settings_about")->num_rows;
        if ($check_about == 0) {

          if (isset($_POST['newdata'])) {
            extract($_REQUEST);
            $sql = "INSERT INTO `settings_about` (`description`) VALUES ('$description')";
            if ($conn->query($sql)) {
              echo redirect($admin_url . 'settings/about');
            }
          }
        } else {
          if (isset($_POST['newdata'])) {
            extract($_REQUEST);
            $sql = "UPDATE `settings_about` SET description = '$description'";
            $qry = $conn->query($sql);
            if ($qry) {
              echo redirect($admin_url . "settings/about");
            }
          }
          $view = $conn->query("SELECT * FROM settings_about")->fetch_assoc();
        }

        // end insert 
      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">About Us</h5>
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                  <textarea class="form-control text" name="description" id="description"><?= $view['description']; ?></textarea>
                  <div class="col-12">
                    <button class="btn btn-primary" name="newdata" type="submit">Update About</button>
                  </div>
                </form>
                <!-- End Custom Styled Validation -->
              </div>
            </div>
          </div>
        </div>
      <?php
      } elseif ($page == "sliderlist") {
      ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Slide Images <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>settings/slidernew">Add Images</a></h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Cover</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM `settings_slider`";
                    $qry = $conn->query($sql);
                    $num = $qry->num_rows;
                    if ($num > 0) {
                      error_reporting(E_ALL);
                      while ($list = $qry->fetch_array()) {
                    ?>
                        <tr>
                          <th scope="row"><?= $sn ?></th>
                          <td>
                            <img src="<?= $base_url . $list['image']; ?>" alt="" class="publisher_id" width="350">
                          </td>
                          <td>
                            <a href="<?= $admin_url ?>settings/slidedelete/<?= $list['slide_id']; ?>" class="btn btn-sm btn-danger"> <i class="ri-delete-bin-2-fill"></i></a>
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
      }elseif($page == 'slidedelete') {
        // echo '23423';
        extract($_REQUEST);
          $sql = "SELECT * FROM `settings_slider` WHERE slide_id = $id";
          $qry = $conn->query($sql);
          $num = $qry->num_rows;
          $delete_slide = $qry->fetch_assoc();
            unlink('../'.$delete_slide['image']);
            // echo '<img src="'.'../../../'.$delete_slide['image'].'">';
          $sql = "DELETE FROM `settings_slider` WHERE `slide_id` = $id";
          $qry = $conn->query($sql);
          if ($qry) {
          echo redirect($admin_url.'settings/sliderlist');
          }
        
        } elseif ($page == "slidernew") {
        if (isset($_POST['newimages'])) {
          extract($_REQUEST);
          $count = count($_FILES['images']['name']);

          $sql = 'INSERT INTO `settings_slider` (`image`) VALUES ';
          for ($i = 0; $i < $count; $i++) {
            $file = uniqid() . $_FILES['images']['name'][$i];
            $file_temp = $_FILES['images']['tmp_name'][$i];
            $file_upload = "../uploads/slider/" . $file;
            $file = "uploads/slider/" . $file;
            if (move_uploaded_file($file_temp, $file_upload)) {
              $sql .= "('$file'),";
            }
          }
          $sql = substr($sql, 0, -1);
          // echo $sql;
          if ($conn->query($sql)) {
            echo redirect($admin_url . 'settings/sliderlist');
          }
        }
      ?>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Upload Slider Images</h5>
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                  <div class="row my-3">
                    <input class="form-control" type="file" name="images[]" id="images" accept=".png, .jpeg" multiple required>
                  </div>
                  <button class="btn btn-primary" name="newimages" type="submit">Upload</button>
              </div>
              </form>
              <!-- End Custom Styled Validation -->
            </div>
          </div>
        </div>
        </div>
      <?php
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