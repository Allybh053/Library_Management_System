
<?php
    error_reporting(E_ALL);
    $lang =  $conn->query("SELECT * FROM settings_language WHERE lang_id = $default_language")->fetch_assoc();
    $BrochureLibrary =  $conn->query("SELECT * FROM settings_brochure_library ORDER BY br_id DESC")->fetch_assoc();
    $LibraryActivity =  $conn->query("SELECT * FROM settings_library_activity ORDER BY ac_id DESC")->fetch_assoc();
?>
<div class="w-100 d-flex justify-content-end">
<select class="my-2" name="" id="language" onchange="language(this.value)">
            <?php

            $sql = "SELECT * FROM `settings_language`";
            $qry = $conn->query($sql);
            $num = $qry->num_rows;
            if ($num > 0) {
                while ($list = $qry->fetch_array()) {
            ?>
                <option <?php if($default_language == $list['lang_id']){echo "selected";}?> value="<?= $list['lang_id']; ?>"><?= $list['lang_name']; ?></option>
            <?php
                }
            }
            ?>
        </select>
        <br>
</div>
<!-- <header class="home-header bg-light">
    <div class="home-header-item-2">
        <img src="<?= $left_logo ?>" alt="">
    </div>
    <div class="home-header-item-8 text-center">
        <h3>Online Public Access Catalog (OPAC)</h3>
        <h1><strong>PERPUSTAKAAN</strong></h1>
        <h3>Akademi Pencegahan Rasuah Malaysia</h3>
    </div>
    <div class="home-header-item-2">
        <img src="<?= $right_logo ?>" alt="">
    </div>
</header> -->
<a href="<?= $base_url ?>">
    <img src="<?= $base_url ?>assets/logo/banner.png" alt="">
</a>