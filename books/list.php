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