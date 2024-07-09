<button type="button" class="btn btn-danger btn-floating btn-lg rounded-5" id="btn-back-to-top">
    Top
</button>
<script src="./assets/js/jquery.min.js"></script>
<footer class="d-flex justify-content-center bg-light">
    <div class="p-3 text-center">

    Hak Cipta Terpelihara &copy; <?= $year ?> <a target="_blank" href="https://gmaca.sprm.gov.my/">AKADEMI PENCEGAHAN RASUAH MALAYSIA</a> <br>
    <!-- <a href="#">Penilaian</a> | <a href="#">Dasar</a> <br> <a href="#">Keselamatan</a> | <a href="#">Notis Hakcipta</a> | <a href="#">Dasar Privasi</a> -->
    Dimiliki oleh  <a target="_blank" href="https://maskavia.com/">Maskavia Sdn Bhd</a>
        <br>
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
    </div>
</footer>
<script>
    let mybutton = document.getElementById("btn-back-to-top");
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    function language(id){
        // alert(id);
        let data = {
            "lang_id" : id,
        }
        $.ajax({
            type: "post",
            url: "inc/language.php",
            data: data,
            dataType: "json",
            success: function (response) {
                window.location.replace("<?= $current_url ?>");
            }
        });
    }
</script>