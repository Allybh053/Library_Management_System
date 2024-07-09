<?php

include('config/app.php');
$sql = "SELECT * FROM books WHERE book_id = '$slug'";
$qry = $conn->query($sql);
$num = $qry->num_rows;
if ($num < 1) {
    header('location:' . $base_url);
}
$view_book = $qry->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPAC</title>
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- End Bootstrap -->
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End Style CSS --> <!-- Favicons -->
    <link href="<?= $favicon ?>" rel="icon">
</head>

<body>
    <?php include('inc/header.php'); ?>
    <?php include('inc/nav.php'); ?>
    <main>
        <section class="bg-light container-fluid my-2 p-2">
            <div class="row">
                <div class="col-md-3">
                    <img src="<?= $view_book['cover_image']; ?>" class="img-fluid mt-4" alt="">
                </div>
                <div class="col-md-6">
                    <nav class="my-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#"><?= $view_book['category_id'] ?></a></li>
                            <li class="breadcrumb-item active"><?= $view_book['book_title']; ?></li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?= $view_book['book_title']; ?></h2>
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="15%"><?= $lang['detail_author']; ?></th>
                                        <td><?= $view_book['author_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $lang['detail_category']; ?></th>
                                        <td><?= $view_book['category_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $lang['detail_publisher']; ?></th>
                                        <td><?= $view_book['publisher_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $lang['detail_published_date']; ?></th>
                                        <td><?= $view_book['published_date']; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex justify-content-end my-2">
                        <div id="qrcode" class="p-2 bg-light"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="p-2 text-justify">
                        <?= $view_book['description']; ?>
                    </div>

                    <!-- <a href="<?= $view_book['file']; ?>" class="btn btn-danger" download>Download Pdf</a> -->
                </div>
            </div>
        </section>
        <section class="bg-light container-fluid my-2 p-2">
            <h3><?= $view_book['category_id']; ?> Books</h3>
            <div class="d-flex flex-wrap justify-content-center gap-2 py-2">
                <?php
                $sql = "SELECT * FROM books WHERE category_id = '" . $view_book['category_id'] . "' ORDER BY book_id DESC LIMIT 6";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                if ($num > 0) {
                    while ($list = $qry->fetch_array()) {
                ?>
                        <a class="book book-info nav-link" href="detail?slug=<?= $list['book_id'] ?>">
                            <div class="card ">
                                <img height="auto" src="<?= $list['cover_image'] ?>" alt="" width="auto">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo  mb_strimwidth($list['book_title'], 0, 50, ' ...'); ?>
                                    </h5>
                                </div>
                            </div>
                        </a>
                <?php
                    }
                }
                ?>
            </div>
        </section>
        <section class="bg-light container-fluid my-2 p-2">
            <h3><?= $view_book['author_id']; ?> Books</h3>
            <div class="d-flex flex-wrap justify-content-center gap-2 py-2">
                <?php
                $sql = "SELECT * FROM books WHERE author_id = '" . $view_book['author_id'] . "' ORDER BY book_id DESC LIMIT 6";
                $qry = $conn->query($sql);
                $num = $qry->num_rows;
                if ($num > 0) {
                    while ($list = $qry->fetch_array()) {
                ?>
                        <a class="book book-info nav-link" href="detail?slug=<?= $list['book_id'] ?>">
                            <div class="card ">
                                <img height="auto" src="<?= $list['cover_image'] ?>" alt="" width="auto">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo  mb_strimwidth($list['book_title'], 0, 50, ' ...'); ?>
                                    </h5>
                                </div>
                            </div>
                        </a>
                <?php
                    }
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
        var qrcode = new QRCode("qrcode",
            "<?= $base_url . $view_book['slug']; ?>");
    </script>
</body>

</html>