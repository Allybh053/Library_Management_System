<?php
if (isset($_POST['page'])) {
    extract($_REQUEST);
    include('config/app.php');
    include_once 'pagination.php';
    include_once 'pagination1.php';
    $baseURL = 'e-book-ajax.php';
    $offset = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = $pageLimit;
    $where = "";
    if ($keywords != '') {
        $where .= " AND book_title LIKE '%" . $keywords . "%' OR description LIKE '%" . $keywords . "%' OR isbn LIKE '%" . $keywords . "%' OR author_id LIKE '%" . $keywords . "%' OR category_id LIKE '%" . $keywords . "%' OR publisher_id LIKE '%" . $keywords . "%'";
    }
    // if ($author_id != '' && $author_id != 0) {
    //     $where .= " AND author_id = $author_id";
    // }
    // if ($category_id != '' && $category_id != 0) {
    //     $where .= " AND category_id = $category_id";
    // }
    // if ($publisher_id != '' && $publisher_id != 0) {
    //     $where .= " AND publisher_id = $publisher_id";
    // }
    if ($sort == 'new') {
        $where .= " ORDER BY book_title ASC";
    } else {
        $where .= " ORDER BY book_title DESC";
    }
    $sql = "SELECT * FROM `books` WHERE status = 1 $where";

    $query = $conn->query($sql);
    $result  = $query->fetch_assoc();
    $rowCount = $query->num_rows;


    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'currentPage' => $offset,
        'contentDiv' => 'dataContainer',
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    $pagination1 =  new Pagination1($pagConfig);

    // Fetch records based on the offset and limit 
    $query = $conn->query("$sql LIMIT $offset,$limit");

    // echo $sql;

?>
    <section class="home-section  my-2" id="dataContainer">
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
<?php
}
?>