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
                                                        <li><a class="dropdown-item" href="<?= $admin_url . 'settings/languagestatus/' . $list['lang_id'] ?>"><?= $list['lang_name']; ?></a></li>
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
                                           // error_reporting(0);
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
            } elseif ($page == 'languagestatus') {
                extract($_REQUEST);
                error_reporting(E_ALL);
                $qry0 = $conn->query("UPDATE `settings_language` SET `status` = 0");
                $sql = "UPDATE `settings_language` SET `status` = '1' WHERE `lang_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . 'settings/languagelist');
                }
            } elseif ($page == "languagenew") {

                if (isset($_POST['addNewLanguage'])) {
                    extract($_REQUEST);
                    $sql = "INSERT INTO `settings_language` (`lang_name`, `home`, `ebook`, `pustaka`, `info_library`, `general_info`, `library_activity`, `web_link`, `brochure_library`, `download`, `index_peraturan_perpustakaan`, `index_latest_e_book_collection`, `index_mengenai_kami`, `index_waktu_perkhidmatan`, `index_hubangi_kami`, `e_book_seach_by_title_isbn`, `e_book_select_category`, `e_book_select_author`, `e_book_select_publisher`, `e_book_sort_old`, `e_book_sort_new`, `detail_author`, `detail_category`, `detail_publisher`, `detail_published_date`, `detail_download_pdf`, `status`, `creator_id`) VALUES ('$lang_name', '$home', '$ebook', '$pustaka', '$info_library', '$general_info', '$library_activity', '$web_link', '$brochure_library', '$download', '$index_peraturan_perpustakaan', '$index_latest_e_book_collection', '$index_mengenai_kami', '$index_waktu_perkhidmatan', '$index_hubangi_kami', '$e_book_seach_by_title_isbn', '$e_book_select_category', '$e_book_select_author', '$e_book_select_publisher', '$e_book_sort_old', '$e_book_sort_new', '$detail_author', '$detail_category', '$detail_publisher', '$detail_published_date', '$detail_download_pdf', '1', '$user_id')";
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
                                        <label for="detail_publisher" class="form-label">Publisher</label>
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
                                        <label for="brochure_library" class="form-label">Brochure Library</label>
                                        <input type="text" class="form-control" id="brochure_library" required name="brochure_library">
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

            } elseif ($page == "languageupdate") {
                error_reporting(E_ALL);
                extract($_REQUEST);
                if (isset($_POST['updateLanguage'])) {
                    extract($_REQUEST);
                    $sql = "UPDATE `settings_language` SET `lang_name` = '$lang_name', `home` = '$home', `ebook` = '$ebook', `pustaka` = '$pustaka', `info_library` = '$info_library', `general_info` = '$general_info', `library_activity` = '$library_activity', `web_link` = '$web_link', `brochure_library` = '$brochure_library', `download` = '$download', `index_peraturan_perpustakaan` = '$index_peraturan_perpustakaan', `index_latest_e_book_collection` = '$index_latest_e_book_collection', `index_mengenai_kami` = '$index_mengenai_kami', `index_waktu_perkhidmatan` = '$index_waktu_perkhidmatan', `index_hubangi_kami` = '$index_hubangi_kami', `e_book_seach_by_title_isbn` = '$e_book_seach_by_title_isbn', `e_book_select_category` = '$e_book_select_category', `e_book_select_author` = '$e_book_select_author', `e_book_select_publisher` = '$e_book_select_publisher', `e_book_sort_old` = '$e_book_sort_old', `e_book_sort_new` = '$e_book_sort_new', `detail_author` = '$detail_author', `detail_category` = '$detail_category', `detail_publisher` = '$detail_publisher', `detail_published_date` = '$detail_published_date', `detail_download_pdf` = '$detail_download_pdf' WHERE `lang_id` = $id";
                    if ($conn->query($sql)) {
                        echo redirect($admin_url . 'settings/languagelist');
                    }
                }
                $sql = "SELECT * FROM `settings_language` WHERE lang_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                if ($num < 1) {
                    echo redirect($admin_url . 'settings/languagelist');
                }
                $edit = $qry->fetch_assoc();

            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Update Language</h5>
                                <!-- Custom Styled Validation -->
                                <form class="g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                                    <div class="row mb-2">
                                        <label for="lang_name" class="form-label">Language Name</label>
                                        <input type="text" class="form-control" id="lang_name" required name="lang_name" value="<?= $edit['lang_name']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="home" class="form-label">Home</label>
                                        <input type="text" class="form-control" id="home" required name="home" value="<?= $edit['home']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="ebook" class="form-label">Book</label>
                                        <input type="text" class="form-control" id="ebook" required name="ebook" value="<?= $edit['ebook']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="pustaka" class="form-label">Pustaka</label>
                                        <input type="text" class="form-control" id="pustaka" required name="pustaka" value="<?= $edit['pustaka']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="info_library" class="form-label">Library</label>
                                        <input type="text" class="form-control" id="info_library" required name="info_library" value="<?= $edit['info_library']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="index_peraturan_perpustakaan" class="form-label">Library Rules</label>
                                        <input type="text" class="form-control" id="index_peraturan_perpustakaan" required name="index_peraturan_perpustakaan" value="<?= $edit['index_peraturan_perpustakaan']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="index_latest_e_book_collection" class="form-label">Latest E-Book Collection</label>
                                        <input type="text" class="form-control" id="index_latest_e_book_collection" required name="index_latest_e_book_collection" value="<?= $edit['index_latest_e_book_collection']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="index_mengenai_kami" class="form-label">About Us</label>
                                        <input type="text" class="form-control" id="index_mengenai_kami" required name="index_mengenai_kami" value="<?= $edit['index_mengenai_kami']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="index_waktu_perkhidmatan" class="form-label">Operation Hours</label>
                                        <input type="text" class="form-control" id="index_waktu_perkhidmatan" required name="index_waktu_perkhidmatan" value="<?= $edit['index_waktu_perkhidmatan']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="index_hubangi_kami" class="form-label">Contact Us</label>
                                        <input type="text" class="form-control" id="index_hubangi_kami" required name="index_hubangi_kami" value="<?= $edit['index_hubangi_kami']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="e_book_seach_by_title_isbn" class="form-label">Search by Title ISBN</label>
                                        <input type="text" class="form-control" id="e_book_seach_by_title_isbn" required name="e_book_seach_by_title_isbn" value="<?= $edit['e_book_seach_by_title_isbn']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="e_book_select_category" class="form-label">Select Category</label>
                                        <input type="text" class="form-control" id="e_book_select_category" required name="e_book_select_category" value="<?= $edit['e_book_select_category']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="e_book_select_author" class="form-label">Select Author</label>
                                        <input type="text" class="form-control" id="e_book_select_author" required name="e_book_select_author" value="<?= $edit['e_book_select_author']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="e_book_select_publisher" class="form-label">Select Publisher</label>
                                        <input type="text" class="form-control" id="e_book_select_publisher" required name="e_book_select_publisher" value="<?= $edit['e_book_select_publisher']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="e_book_sort_old" class="form-label">Sort Old</label>
                                        <input type="text" class="form-control" id="e_book_sort_old" required name="e_book_sort_old" value="<?= $edit['e_book_sort_old']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="e_book_sort_new" class="form-label">Sort New</label>
                                        <input type="text" class="form-control" id="e_book_sort_new" required name="e_book_sort_new" value="<?= $edit['e_book_sort_new']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="detail_author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="detail_author" required name="detail_author" value="<?= $edit['detail_author']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="detail_category" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="detail_category" required name="detail_category" value="<?= $edit['detail_category']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="detail_publisher" class="form-label">Publisher</label>
                                        <input type="text" class="form-control" id="detail_publisher" required name="detail_publisher" value="<?= $edit['detail_publisher']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="detail_published_date" class="form-label">Published Date</label>
                                        <input type="text" class="form-control" id="detail_published_date" required name="detail_published_date" value="<?= $edit['detail_published_date']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="detail_download_pdf" class="form-label">Download Pdf</label>
                                        <input type="text" class="form-control" id="detail_download_pdf" required name="detail_download_pdf" value="<?= $edit['detail_download_pdf']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="general_info" class="form-label">General Info</label>
                                        <input type="text" class="form-control" id="general_info" required name="general_info" value="<?= $edit['general_info']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="library_activity" class="form-label">Library Activity</label>
                                        <input type="text" class="form-control" id="library_activity" required name="library_activity" value="<?= $edit['library_activity']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="web_link" class="form-label">Web Link</label>
                                        <input type="text" class="form-control" id="web_link" required name="web_link" value="<?= $edit['web_link']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="brochure_library" class="form-label">Brochure Library</label>
                                        <input type="text" class="form-control" id="brochure_library" required name="brochure_library" value="<?= $edit['brochure_library']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <label for="download" class="form-label">Download</label>
                                        <input type="text" class="form-control" id="download" required name="download" value="<?= $edit['download']; ?>">
                                    </div>
                                    <div class="row mb-2">
                                        <button class="btn btn-primary" name="updateLanguage" type="submit">Update</button>
                                    </div>
                                </form>
                                <!-- End Custom Styled Validation -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php } elseif ($page == "about") {
                $check_about = $conn->query("SELECT * FROM settings_about")->num_rows;
                if ($check_about == 0) {

                    if (isset($_POST['newdata'])) {
                        extract($_REQUEST);
                        $description = $conn->real_escape_string($_POST['description']);
                        $sql = "INSERT INTO `settings_about` (`description`) VALUES ('$description')";
                        if ($conn->query($sql)) {
                            echo redirect($admin_url . 'settings/about');
                        } 
                    }
                } else {
                    if (isset($_POST['newdata'])) {
                        extract($_REQUEST);
                        $description = $conn->real_escape_string($_POST['description']);
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
            } elseif ($page == 'slidedelete') {
                // echo '23423';
                extract($_REQUEST);
                $sql = "SELECT * FROM `settings_slider` WHERE slide_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                $delete_slide = $qry->fetch_assoc();
                unlink('../' . $delete_slide['image']);
                // echo '<img src="'.'../../../'.$delete_slide['image'].'">';
                $sql = "DELETE FROM `settings_slider` WHERE `slide_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . 'settings/sliderlist');
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
            } elseif ($page == "password") {

            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <!-- Custom Styled Validation -->
                                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>">
                                    <?php
                                    if (isset($_POST['changePassword'])) {
                                        extract($_REQUEST);
                                        error_reporting(E_ALL);
                                        $check = $conn->query("SELECT * FROM user WHERE user_id  = $user_id AND password = '$oldpassword'")->num_rows;
                                        if ($check == 0) {
                                            echo '<div class="alert alert-danger">
                        <b>Please enter Your Current Password!</b>
                      </div>';
                                        } else {
                                            if ($newpassword == $confirmpassword) {
                                                $sql = "UPDATE user SET password = '$newpassword' WHERE user_id = $user_id";
                                                if ($conn->query($sql)) {
                                                    echo '<div class="alert alert-success">
                            <b>Password Successfully Changed!</b>
                          </div>';
                                                }
                                            } else {
                                                echo '<div class="alert alert-danger">
                          <b>Please enter Correct Confirm Password!</b>
                        </div>';
                                            }
                                        }
                                    }
                                    ?>


                                    <div class="rob mb-3">
                                        <label for="oldpassword">Current Password</label>
                                        <input type="password" class="form-control" name="oldpassword" id="oldpassword" required>
                                    </div>
                                    <div class="rob mb-3">
                                        <label for="newpassword">New Password</label>
                                        <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                                    </div>
                                    <div class="rob mb-3">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" name="changePassword" type="submit">Change Password</button>
                                    </div>
                                </form>
                                <!-- End Custom Styled Validation -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } elseif ($page == "ruleImage") {
            ?>
                ruleImage

            <?php
            } elseif ($page == "libraryActivity") {

                if (isset($_POST['NewActivity'])) {
                    // echo $_FILES['activity']['size'];
                    if ($_FILES['activity']['size'] > 0) {
                        //echo "file";
                        // FILE
                        extract($_REQUEST);
                        error_reporting(E_ALL);
                        $cover = uniqid() . $_FILES['activity']['name'];
                        $cover_temp = $_FILES['activity']['tmp_name'];
                        $cover_upload = "../uploads/activity/" . $cover;
                        $cover = "uploads/activity/" . $cover;
                        if (move_uploaded_file($cover_temp, $cover_upload)) {
                            // file image
                            $sql = "INSERT INTO `settings_library_activity` (`type`, `heading`, `page`, `text`, `date`, `creator_id`) VALUES ('file', '$heading', 'activity', '$cover', '$date', '$user_id')";
                            if ($conn->query($sql)) {
                                echo '<script>alert("Successfully Updated...")</script>';
                                echo redirect($admin_url . 'settings/libraryActivity');
                            }
                            // end file image
                        }
                        // end FILE
                    } else {
                        // echo "text";
                        extract($_REQUEST);
                        $activity = $conn->real_escape_string($_POST['activity']);
                        $sql = "INSERT INTO `settings_library_activity` (`type`, `heading`, `page`, `text`, `date`, `creator_id`) VALUES ('text', '$heading','activity', '$activity', '$date', '$user_id')";
                        echo $sql;

                        if ($conn->query($sql)) {
                            echo '<script>alert("Successfully Updated...")</script>';
                            echo redirect($admin_url . 'settings/libraryActivity');
                        }
                    }
                }
            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Activity</h5>
                                <!-- Custom Styled Validation -->
                                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                                    <div class="rob mb-3">
                                        <label for="oldpassword">Activity Type</label>
                                        <select name="type" id="activity_type" class="form-control" required onchange="changeActivity(this.value)">
                                            <option selected disabled>-- Choose -- </option>
                                            <option value="gform">Google Form</option>
                                            <option value="pdf">PDF Download</option>
                                        </select>
                                    </div>
                                    <div class="rob mb-3">
                                        <label for="heading">Heading</label>
                                        <input type="text" class="form-control" name="heading" id="heading">
                                    </div>
                                    <div class="rob mb-3">
                                        <label for="activity">Activity</label>
                                        <input type="text" class="form-control" name="activity" id="activity">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" name="NewActivity" type="submit">Create</button>
                                    </div>
                                </form>
                                <!-- End Custom Styled Validation -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } elseif ($page == "libraryActivityList") {
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List Library Activity <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>settings/libraryActivity">Add Activity</a></h5>
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Activity</th>
                                            <th scope="col">Date</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `settings_library_activity` WHERE page = 'activity'";
                                        $qry = $conn->query($sql);
                                        $num = $qry->num_rows;
                                        if ($num > 0) {
                                            error_reporting(E_ALL);
                                            while ($list = $qry->fetch_array()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?= $sn ?></th>
                                                    <td>
                                                        <?= $list['heading']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['text']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['date']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= $admin_url ?>settings/libraryActivityDelete/<?= $list['ac_id']; ?>" class="btn btn-sm btn-danger"> <i class="ri-delete-bin-2-fill"></i></a>
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

            } elseif ($page == "libraryActivityDelete") {


                extract($_REQUEST);
                $sql = "SELECT * FROM `settings_library_activity` WHERE ac_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                $delete_slide = $qry->fetch_assoc();
                unlink('../' . $delete_slide['text']);
                $sql = "DELETE FROM `settings_library_activity` WHERE `ac_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . 'settings/libraryActivityList');
                }
            } elseif ($page == "Brochurelibrary") {

                if (isset($_POST['NewBrochure'])) {
                    // FILE
                    error_reporting(E_ALL);
                    $cover = uniqid() . $_FILES['text']['name'];
                    $cover_temp = $_FILES['text']['tmp_name'];
                    $cover_upload = "../uploads/brochure/" . $cover;
                    $cover = "uploads/brochure/" . $cover;
                    if (move_uploaded_file($cover_temp, $cover_upload)) {
                        // file image
                        $sql = "INSERT INTO `settings_brochure_library` (`type`, `text`, `date`, `creator_id`) VALUES ('file', '$cover', '$date', '$user_id')";
                        if ($conn->query($sql)) {

                            echo '<script>alert("Successfully Updated...")</script>';
                            echo redirect($admin_url . 'settings/Brochurelibrary');
                        }
                        // end file image
                    }
                    // end FILE
                }
            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Brochure </h5>
                                <!-- Custom Styled Validation -->
                                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                                    <div class="rob mb-3">
                                        <label for="Brochure">Brochure File</label>
                                        <input type="file" ccept="application/pdf" class="form-control" name="text" id="Brochure">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" name="NewBrochure" type="submit">Create</button>
                                    </div>
                                </form>
                                <!-- End Custom Styled Validation -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } elseif ($page == "downloadActivity") {

                if (isset($_POST['NewDownload'])) {
                    // echo $_FILES['activity']['size'];
                    if ($_FILES['download_act']['size'] > 0) {
                        echo "file";
                        // FILE
                        extract($_REQUEST);
                        error_reporting(E_ALL);
                        $cover = uniqid() . $_FILES['download_act']['name'];
                        $cover_temp = $_FILES['download_act']['tmp_name'];
                        $cover_upload = "../uploads/download/" . $cover;
                        $cover = "uploads/download/" . $cover;
                        if (move_uploaded_file($cover_temp, $cover_upload)) {
                            // file image
                            $sql = "INSERT INTO `settings_library_activity` (`type`, `heading`, `page`, `text`, `date`, `creator_id`) VALUES ('file', '$heading', 'download', '$cover', '$date', '$user_id')";
                            if ($conn->query($sql)) {
                                echo '<script>alert("Successfully Updated...")</script>';
                                echo redirect($admin_url . 'settings/downloadActivity');
                            }
                            // end file image
                        }
                        // end FILE
                    } else {
                        // echo "text";
                        extract($_REQUEST);
                        $download_act = $conn->real_escape_string($_POST['download_act']);
                        $sql = "INSERT INTO `settings_library_activity` (`type`, `page`, `heading`, `text`, `date`, `creator_id`) VALUES ('text', 'download', '$heading', '$download_act', '$date', '$user_id')";
                        //echo $sql;

                        if ($conn->query($sql)) {
                            echo '<script>alert("Successfully Updated...")</script>';
                            echo redirect($admin_url . 'settings/downloadActivity');
                        }
                    }
                }
            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Download Activity</h5>
                                <!-- Custom Styled Validation -->
                                <form class="row g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                                    <div class="rob mb-3">
                                        <label for="oldpassword">Download Activity Type</label>
                                        <select name="type" id="activity_type" class="form-control" required onchange="changedActivity(this.value)">
                                            <option selected disabled>-- Choose -- </option>
                                            <option value="gform">Google Form</option>
                                            <option value="pdf">PDF Download</option>
                                        </select>
                                    </div>
                                    <div class="rob mb-3">
                                        <label for="heading">Download Heading</label>
                                        <input type="text" class="form-control" name="heading" id="heading">
                                    </div>
                                    <div class="rob mb-3">
                                        <label for="download_act">Download Activity</label>
                                        <input type="text" class="form-control" name="download_act" id="download_act">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" name="NewDownload" type="submit">Create</button>
                                    </div>
                                </form>
                                <!-- End Custom Styled Validation -->
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } elseif ($page == "downloadActivityList") {
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List Download Activity <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>settings/downloadActivity">Add Download Activity</a></h5>
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Activity</th>
                                            <th scope="col">Date</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `settings_library_activity` WHERE page = 'download'";
                                        $qry = $conn->query($sql);
                                        $num = $qry->num_rows;
                                        if ($num > 0) {
                                            error_reporting(E_ALL);
                                            while ($list = $qry->fetch_array()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?= $sn ?></th>
                                                    <td>
                                                        <?= $list['heading']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['text']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['date']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= $admin_url ?>settings/downloadActivityDelete/<?= $list['ac_id']; ?>" class="btn btn-sm btn-danger"> <i class="ri-delete-bin-2-fill"></i></a>
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

            } elseif ($page == "downloadActivityDelete") {


                extract($_REQUEST);
                $sql = "SELECT * FROM `settings_library_activity` WHERE ac_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                $delete_slide = $qry->fetch_assoc();
                unlink('../' . $delete_slide['text']);
                $sql = "DELETE FROM `settings_library_activity` WHERE `ac_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . 'settings/downloadActivityList');
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

        function changeActivity(val) {
            if (val === "gform") {
                document.getElementById("activity").type = "text";
            } else if (val === "pdf") {
                document.getElementById("activity").type = "file";
            }

        }

        function changedActivity(val) {
            if (val === "gform") {
                document.getElementById("download_act").type = "text";
            } else if (val === "pdf") {
                document.getElementById("download_act").type = "file";
            }

        }
    </script>
</body>

</html>