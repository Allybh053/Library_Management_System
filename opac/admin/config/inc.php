
<?php


    function Creator($conn,$id)
    {
        // return $id;
		error_reporting(0);
        $user = $conn->query("SELECT * FROM user WHERE user_id = $id")->fetch_assoc();
        return $user['name'];
    }
    
    function dateView($date){
        $date=date_create($date);
        return date_format($date,"d/m/Y");
    }

    function removeChar($get_string)
    {
        $response = str_replace(array('\'', '"', '.', ',', ';', '<', '>', '/', '*', '+', '=', '^', '@', '#', '!', '`', '~', '$', '%', '&', '(', ')', '_', ' ', '–', '|', ',', "'", '{', '}', '[', ']', '?'), '-', $get_string);
        return $response;
    }
    function category($conn,$id)
    {
        $category = $conn->query("SELECT * FROM category WHERE category_id = $id")->fetch_assoc();
        return $category['category_name'];
    }

    function publisher($conn,$id)
    {
        $publisher = $conn->query("SELECT * FROM publisher WHERE publisher_id = $id")->fetch_assoc();
        return $publisher['publisher_name'];
    }

    function author($conn,$id)
    {
        $author = $conn->query("SELECT * FROM author WHERE author_id = $id")->fetch_assoc();
        return $author['aurthor_name'];
    }

    function redirect($url){
        $goto = '<script>window.location.href="'.$url.'"</script>';
        return $goto;
    }
?>