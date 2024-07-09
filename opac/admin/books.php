<?php
include('../config/app.php');
include('inc/access.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Books</title>
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
            <h1>Books</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $admin_url ?>">Home</a></li>
                    <li class="breadcrumb-item">Book</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <?php

            if ($page == "list") {
                $sql = "SELECT * FROM `books`";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
            ?>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List Books <a class="btn btn-sm btn-primary float-end" href="<?= $admin_url ?>books/new">Add Book</a></h5>
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Cover</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Aurthor</th>
                                            <th scope="col">Publisher</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Published Date</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Creator</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($num > 0) {
                                            // error_reporting(E_ALL);
                                            while ($list = $qry->fetch_array()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?= $sn ?></th>
                                                    <td>
                                                        <img src="<?= $base_url . $list['cover_image']; ?>" alt="" class="publisher_id" width="150">
                                                    </td>
                                                    <td><?= $list['book_title']; ?></td>
                                                    <td><?= $list['author_id']; ?></td>
                                                    <td><?= $list['publisher_id']; ?></td>
                                                    <td><?= $list['category_id']; ?></td>
                                                    <td><?= $list['published_date']; ?></td>
                                                    <td><?= $list['created_at']; ?></td>
                                                    <td><?= $list['updated_at']; ?></td>
                                                    <td><?php echo Creator($conn, $list['creator_id']) ?></td>
                                                    <td>
                                                        <?php
                                                        if ($list['status'] == 1) {
                                                            echo '<a class="btn btn-sm btn-success" href="' . $admin_url . 'books/status/' . $list['book_id'] . '/0"><i class="ri-eye-fill"></i></a>';
                                                        } else {
                                                            echo '<a class="btn btn-sm btn-danger" href="' . $admin_url . 'books/status/' . $list['book_id'] . '/1"><i class="ri-eye-off-fill"></i></a>';
                                                        }
                                                        ?>
                                                        <a class="btn btn-sm btn-warning" href="<?= $admin_url ?>books/update/<?= $list['book_id'] ?>"><i class="ri-pencil-fill"></i></a>

                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteView<?= $list['book_id'] ?>">
                                                            <i class="ri-delete-bin-2-fill"></i>
                                                        </button>
                                                        <div class="modal fade" id="deleteView<?= $list['book_id'] ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"><?= $list['book_title']; ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to delete <b><?= $list['book_title']; ?></b> </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <a href="<?= $admin_url . 'books/delete/' . $list['book_id'] ?>" class="btn btn-danger">Yes Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- End Large Modal-->



                                                        <!-- Large Modal -->
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bookView<?= $list['book_id'] ?>">
                                                            <i class="ri-discuss-fill"></i>
                                                        </button>

                                                        <div class="modal fade" id="bookView<?= $list['book_id'] ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"><?= $list['book_title']; ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Book Title</div>
                                                                            <div class="col-sm-10"><?= $list['book_title']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Book ISBN</div>
                                                                            <div class="col-sm-10"><?= $list['isbn']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Volume</div>
                                                                            <div class="col-sm-10"><?= $list['volume_name']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Category</div>
                                                                            <div class="col-sm-10"><?= $list['category_id']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Author</div>
                                                                            <div class="col-sm-10"><?= $list['author_id']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Publisher</div>
                                                                            <div class="col-sm-10"><?= $list['publisher_id']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Description</div>
                                                                            <div class="col-sm-10"><?= $list['description']; ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Date</div>
                                                                            <div class="col-sm-10"><?= dateView($list['published_date']); ?></div>
                                                                        </div>
                                                                        <div class="row mb-3 border p-2">
                                                                            <div class="col-sm-2 text-end">Cover</div>
                                                                            <div class="col-sm-10"><img src="<?= $base_url . $list['cover_image']; ?>" alt="" class="publisher_id" width="100%"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                if (isset($_POST['newBook'])) {
                    extract($_REQUEST);
                    // error_reporting(E_ALL);
                    // cover image
                    $cover = uniqid() . $_FILES['cover_image']['name'];
                    $cover_temp = $_FILES['cover_image']['tmp_name'];
                    $cover_upload = "../uploads/cover_image/" . $cover;
                    $cover = "uploads/cover_image/" . $cover;
                    if (move_uploaded_file($cover_temp, $cover_upload)) {
                        // file image
                        $file = uniqid() . $_FILES['file']['name'];
                        $file = removeChar($file);
                        $file_temp = $_FILES['file']['tmp_name'];
                        $file_upload = "../uploads/files/" . $file;
                        $file = "uploads/files/" . $file;
                        if (move_uploaded_file($file_temp, $file_upload)) {
                            // $book_title = $conn->real_escape_string($_POST['book_title']);
                            // $volume_name = $conn->real_escape_string($_POST['volume_name']);
                            // $description = $conn->real_escape_string($_POST['description']);
                            $book_title = $conn->real_escape_string($_POST['book_title']);
                            $volume_name = $conn->real_escape_string($_POST['volume_name']);
                            $description = $conn->real_escape_string($_POST['description']);
                            $publisher_id = $conn->real_escape_string($_POST['publisher_id']);
                            $category_id = $conn->real_escape_string($_POST['category_id']);
                            $author_id = $conn->real_escape_string($_POST['author_id']);
                            $isbn = $conn->real_escape_string($_POST['isbn']);
                            $slug = $file;
                            $sql = "INSERT INTO `books` (`author_id`, `category_id`, `publisher_id`, `book_title`, `slug`, `isbn`, `volume_name`, `published_date`, `cover_image`, `description`, `file`, `created_at`, `status`, `creator_id`) VALUES ('$author_id', '$category_id', '$publisher_id', '$book_title', '$slug', '$isbn', '$volume_name', '$published_date', '$cover', '$description', '$file', '$dateTime',1, '$user_id')";
                            if ($conn->query($sql)) {
                                echo redirect($admin_url . 'books/list');
                            }
                        }
                        // end file image
                    }
                    // end cover image
                }
                // end insert 
            ?>
            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Book</h5>
                                <!-- Custom Styled Validation -->
                                <form class="g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="book_title" class="col-sm-2 col-form-label text-end">Book Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="book_title" required name="book_title">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="isbn" class="col-sm-2 col-form-label text-end">Book ISBN</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="isbn" required name="isbn">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="volume_name" class="col-sm-2 col-form-label text-end">Volume No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="volume_name" name="volume_name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category_id" class="col-sm-2 col-form-label text-end">Category</label>
                                        <div class="col-sm-10">
                                            <!-- <select class="form-select" id="category_id" required name="category_id">
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                $qry = $conn->query("SELECT * FROM category WHERE status = 1");
                                                while ($list = $qry->fetch_array()) {
                                                ?>
                                                    <option value="<?= $list['category_id']; ?>"><?= $list['category_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> -->
                                            <input type="text" class="form-control" id="category_id" name="category_id">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="author_id" class="col-sm-2 col-form-label text-end">Author</label>
                                        <div class="col-sm-10">
                                            <!-- <select class="form-select" id="author_id" required name="author_id">
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                $qry = $conn->query("SELECT * FROM author WHERE status = 1");
                                                while ($list = $qry->fetch_array()) {
                                                ?>
                                                    <option value="<?= $list['author_id']; ?>"><?= $list['aurthor_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> -->
                                            <input type="text" class="form-control" id="author_id" name="author_id">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="publisher_id" class="col-sm-2 col-form-label text-end">Publisher</label>
                                        <div class="col-sm-10">
                                            <!-- <select class="form-select" id="publisher_id" required name="publisher_id">
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                $qry = $conn->query("SELECT * FROM publisher WHERE status = 1");
                                                while ($list = $qry->fetch_array()) {
                                                ?>
                                                    <option value="<?= $list['publisher_id']; ?>"><?= $list['publisher_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> -->
                                            <input type="text" class="form-control" id="publisher_id" name="publisher_id">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="published_date" class="col-sm-2 col-form-label text-end">Release Date</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="published_date" name="published_date" value="<?= $year ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="description" class="col-sm-2 col-form-label text-end">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cover_image" class="col-sm-2 col-form-label text-end">Cover Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="cover_image" required name="cover_image" accept=".png, .jpeg" onchange="readURL(this);">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="file" class="col-sm-2 col-form-label text-end">File</label>
                                        <div class="col-sm-10">
                                            <input type="file" accept=".pdf" class="form-control" id="file" required name="file">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary"  name="newBook" type="submit">Add Book</button>
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

                $sql = "SELECT * FROM `books` WHERE book_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                if ($num < 1) {
                    echo redirect($admin_url . "books/list");
                }
                $edit = $qry->fetch_assoc();


                if (isset($_POST['updateBook'])) {
                    extract($_REQUEST);
                    // cover image
                    if ($_FILES['cover_image']['name'] != '') {
                        if (unlink("../" . $edit['cover_image'])) {
                            $cover = uniqid() . $_FILES['cover_image']['name'];
                            $cover_temp = $_FILES['cover_image']['tmp_name'];
                            $cover_upload = "../uploads/cover_image/" . $cover;
                            $cover = "uploads/cover_image/" . $cover;
                            move_uploaded_file($cover_temp, $cover_upload);
                            
                            $updateSql = $conn->query("UPDATE `books` SET `cover_image` = '$cover' WHERE `book_id` = $id");
                        //    echo redirect($admin_url . "books/list");
                        }
                    }
                    // end cover image

                    // file image
                    if ($_FILES['file']['name'] != '') {
                        if (unlink("../" . $_POST['old_file'])) {
                            $file = uniqid() . $_FILES['file']['name'];
                            $file = removeChar($file);
                            $file_temp = $_FILES['file']['tmp_name'];
                            $file_upload = "../uploads/files/" . $file;
                            $file = "uploads/files/" . $file;
                            if (move_uploaded_file($file_temp, $file_upload)) {
                                // $book_title = $conn->real_escape_string($_POST['book_title']);
                                // $volume_name = $conn->real_escape_string($_POST['volume_name']);
                                // $description = $conn->real_escape_string($_POST['description']);
                                $book_title = $conn->real_escape_string($_POST['book_title']);
                                $volume_name = $conn->real_escape_string($_POST['volume_name']);
                                $description = $conn->real_escape_string($_POST['description']);
                                $publisher_id = $conn->real_escape_string($_POST['publisher_id']);
                                $category_id = $conn->real_escape_string($_POST['category_id']);
                                $author_id = $conn->real_escape_string($_POST['author_id']);
                                $isbn = $conn->real_escape_string($_POST['isbn']);
                                $slug = $file;

                                $updateSql = $conn->query("UPDATE `books` SET `slug` = '$slug', `file` = '$file' WHERE `book_id` = $id");
                            }
                        }
                    }
                    // end file image


                    // $book_title = $conn->real_escape_string($_POST['book_title']);
                    // $volume_name = $conn->real_escape_string($_POST['volume_name']);
                    // $description = $conn->real_escape_string($_POST['description']);
                    $book_title = $conn->real_escape_string($_POST['book_title']);
                    $volume_name = $conn->real_escape_string($_POST['volume_name']);
                    $description = $conn->real_escape_string($_POST['description']);
                    $publisher_id = $conn->real_escape_string($_POST['publisher_id']);
                    $category_id = $conn->real_escape_string($_POST['category_id']);
                    $author_id = $conn->real_escape_string($_POST['author_id']);
                    $isbn = $conn->real_escape_string($_POST['isbn']);
                    
                    $sql = "UPDATE `books` SET `author_id` = '$author_id', `category_id` = '$category_id', `publisher_id` = '$publisher_id', `book_title` = '$book_title', `isbn` = '$isbn', `volume_name` = '$volume_name', `published_date` = '$published_date', `description` = '$description', `updated_at` = '$dateTime' WHERE `book_id` = $id";
                    $qry = $conn->query($sql);
                 
                    echo redirect($admin_url . "books/list");
                }
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Update Book</h5>
                                <!-- Custom Styled Validation -->
                                <form class="g-3 needs-validation" novalidate method="post" action="<?= $current_url ?>" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="book_title" class="col-sm-2 col-form-label text-end">Book Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="book_title" required name="book_title" value="<?= $edit['book_title']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="isbn" class="col-sm-2 col-form-label text-end">Book ISBN</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="isbn" required name="isbn" value="<?= $edit['isbn']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="volume_name" class="col-sm-2 col-form-label text-end">Volume No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="volume_name" name="volume_name" value="<?= $edit['volume_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category_id" class="col-sm-2 col-form-label text-end">Category</label>
                                        <div class="col-sm-10">
                                            <!-- <select class="form-select" id="category_id" required name="category_id">
                                                <option disabled value="">Choose...</option>
                                                <?php
                                                $qry = $conn->query("SELECT * FROM category WHERE status = 1");
                                                while ($list = $qry->fetch_array()) {
                                                ?>
                                                    <option <?php if ($edit['category_id'] == $list['category_id']) {
                                                                echo "selected";
                                                            } ?> value="<?= $list['category_id']; ?>"><?= $list['category_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> -->
                                            <input type="text" class="form-control" id="category_id" name="category_id" value="<?= $edit['category_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="author_id" class="col-sm-2 col-form-label text-end">Author</label>
                                        <div class="col-sm-10">
                                            <!-- <select class="form-select" id="author_id" required name="author_id">
                                                <option disabled value="">Choose...</option>
                                                <?php
                                                $qry = $conn->query("SELECT * FROM author WHERE status = 1");
                                                while ($list = $qry->fetch_array()) {
                                                ?>
                                                    <option <?php if ($edit['author_id'] == $list['author_id']) {
                                                                echo "selected";
                                                            } ?> value="<?= $list['author_id']; ?>"><?= $list['aurthor_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> -->
                                            <input type="text" class="form-control" id="author_id" name="author_id" value="<?= $edit['author_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="publisher_id" class="col-sm-2 col-form-label text-end">Publisher</label>
                                        <div class="col-sm-10">
                                            <!-- <select class="form-select" id="publisher_id" required name="publisher_id">
                                                <option disabled value="">Choose...</option>
                                                <?php
                                                $qry = $conn->query("SELECT * FROM publisher WHERE status = 1");
                                                while ($list = $qry->fetch_array()) {
                                                ?>
                                                    <option <?php if ($edit['publisher_id'] == $list['publisher_id']) {
                                                                echo "selected";
                                                            } ?> value="<?= $list['publisher_id']; ?>"><?= $list['publisher_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> -->
                                            <input type="text" class="form-control" id="publisher_id" name="publisher_id" value="<?= $edit['publisher_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="published_date" class="col-sm-2 col-form-label text-end">Release Date</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="published_date" required name="published_date" value="<?= $edit['published_date']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="description" class="col-sm-2 col-form-label text-end">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required><?= $edit['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cover_image" class="col-sm-2 col-form-label text-end">Cover Image</label>
                                        <div class="col-sm-10">
                                            <?php
                                            if ($edit['cover_image'] != '') {
                                                $required = "";
                                                echo '<img src="' . $base_url . $edit['cover_image'] . '" alt="" width="250px">';
                                                echo '<input type="hidden" name="old_file" value="'.$edit['file'].'">';
                                            } else {
                                                $required = "required";
                                            }
                                            ?>
                                            <input type="file" <?= $required ?> class="form-control mt-2" id="cover_image" name="cover_image" accept=".png, .jpeg">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="file" class="col-sm-2 col-form-label text-end">File</label>
                                        <div class="col-sm-10">
                                            <?php
                                            if ($edit['file'] != '') {
                                                $frequired = "";
                                            } else {
                                                $frequired = "required";
                                            }
                                            ?>
                                            <input type="file" <?= $frequired ?> accept=".pdf" class="form-control" id="file" name="file">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary" name="updateBook" type="submit">Update Book</button>
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
                $sql = "UPDATE `books` SET `status` = '$status' WHERE `book_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . "books/list");
                }
            } elseif ($page == 'delete') {
                // echo '23423';
                extract($_REQUEST);
                $sql = "SELECT * FROM `books` WHERE book_id = $id";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                $delete_book = $qry->fetch_assoc();
                unlink('../' . $delete_book['cover_image']);
                // echo '<img src="'.'../../../'.$delete_book['cover_image'].'">';
                $sql = "DELETE FROM `books` WHERE `book_id` = $id";
                $qry = $conn->query($sql);
                if ($qry) {
                    echo redirect($admin_url . "books/list");
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

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
        config.plugins.image = 0;
    config.plugins.pwimage = 0;
</script>
</body>

</html>