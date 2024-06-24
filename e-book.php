<?php

include('config/app.php');
include_once 'pagination.php';
include_once 'pagination1.php';
$baseURL = 'e-book-ajax.php';
$limit = $pageLimit;
$sql = "SELECT * FROM books ORDER BY book_title ASC";
$query = $conn->query($sql);
$result  = $query->fetch_assoc();
$rowCount = $query->num_rows;
$pagConfig = array(
    'baseURL' => $baseURL,
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'contentDiv' => 'dataContainer',
    'link_func' => 'searchFilter'
);
$pagination =  new Pagination($pagConfig);
$pagination1 =  new Pagination1($pagConfig);

$query = $conn->query("$sql LIMIT $limit");
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
        <section class="bg-light container-fluid my-2">
            <div class="d-flex flex-wrap justify-content-around p-3">
                <div class="col-md-12 p-1">
                    <input type="text" name="" id="keywords" class="form-control" placeholder="<?= $lang['e_book_seach_by_title_isbn']; ?>" onkeyup="searchFilter();">
                </div>
                <!-- <div class="col-md-3 p-1">
                    <select name="category_id" id="category_id" class="form-control" onchange="searchFilter();">
                        <option value="0">-- <?= $lang['e_book_select_category']; ?> --</option>
                        <?php
                        $qry = $conn->query("SELECT * FROM category WHERE status = 1 ORDER BY category_name ASC");
                        while ($list = $qry->fetch_array()) {
                        ?>
                            <option value="<?= $list['category_id']; ?>"><?= $list['category_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 p-1">
                    <select name="author_id" id="author_id" class="form-control" onchange="searchFilter();">
                        <option value="0">-- <?= $lang['e_book_select_author']; ?> --</option>
                        <?php
                        $qry = $conn->query("SELECT * FROM author WHERE status = 1 ORDER BY aurthor_name ASC");
                        while ($list = $qry->fetch_array()) {
                        ?>
                            <option value="<?= $list['author_id']; ?>"><?= $list['aurthor_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 p-1">
                    <select name="publisher_id" id="publisher_id" class="form-control" onchange="searchFilter();">
                        <option value="0">-- <?= $lang['e_book_select_publisher']; ?> --</option>
                        <?php
                        $qry = $conn->query("SELECT * FROM publisher WHERE status = 1 ORDER BY publisher_name ASC");
                        while ($list = $qry->fetch_array()) {
                        ?>
                            <option value="<?= $list['publisher_id']; ?>"><?= $list['publisher_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div> -->
                <div class="col-md-3 p-1">
                    <select name="sort" id="sort" class="form-control" onchange="searchFilter();">
                        <option value="new"><?= $lang['e_book_sort_new']; ?></option>
                        <option value="old"><?= $lang['e_book_sort_old']; ?></option>
                    </select>
                </div>
            </div>
        </section>
        <section class="bg-light  my-2" id="dataContainer">
            <div class="container pt-4">
                <div class="alert show-alert">
                    <?php echo $pagination1->createLinks(); ?>
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-2 py-2">
                    <?php
                    while ($list = $query->fetch_assoc()) {
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
                    ?>
                </div>
                <div class="row" id="pagination">
                    <div class="col-md-12">
                        <?php echo $pagination->createLinks(); ?>
                    </div>
                </div>
            </div>

        </section>

    </main>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <?php include('inc/footer.php'); ?>
    <!-- Bootstrap -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchFilter(page_num) {
            // alert();
            page_num = page_num ? page_num : 0;
            let keywords = $('#keywords').val();
            let category_id = $('#category_id').val();
            let author_id = $('#author_id').val();
            let publisher_id = $('#publisher_id').val();
            let sort = $('#sort').val();
            // alert(keywords);
            $.ajax({
                type: 'POST',
                url: '<?= $baseURL ?>',
                data: {
                    "page": page_num,
                    'keywords': keywords,
                    'category_id': category_id,
                    'author_id': author_id,
                    'publisher_id': publisher_id,
                    'sort': sort,
                },
                beforeSend: function() {
                    $('.loading-overlay').show();
                },
                success: function(html) {
                    $('.loading-overlay').hide();
                    $('#dataContainer').html(html);
                }
            });
        }
    </script>
</body>

</html>