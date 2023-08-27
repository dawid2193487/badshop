<?php 

include_once 'get_mysqli.php';
include_once 'user.php';

// define(SIGN_IN_PATH, "/sign_in.php");
const UPLOAD_PATH = "/code/uploads/";

function create_media($product_pk) {
    // provides a unrestricted file upload vuln
    force_authenticated();
    $mysqli = get_mysqli();
    $file_ext = strtolower(pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION));
    
    $qstring = "
        INSERT INTO Media (product_pk, file_ext) 
        VALUES (".$product_pk.",'".$file_ext."');";

    $product_created = $mysqli->query($qstring);
    
    if (!$product_created) {
        return "Nie udało się dodać pliku.";
    }
    
    $media_pk = $mysqli->insert_id;
    $target_file = UPLOAD_PATH . $media_pk . "." . $file_ext;

    move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file);
    
    return $media_pk;
}

function create_media_from_url($product_pk, $url) {
    // provides unrestricted file upload vuln
    // provides     
    force_authenticated();
    $mysqli = get_mysqli();
    $contents = file_get_contents($url);
    $file_ext = strtolower(pathinfo($url, PATHINFO_EXTENSION));
    
    $qstring = "
        INSERT INTO Media (product_pk, file_ext) 
        VALUES (".$product_pk.",'".$file_ext."');";

    $product_created = $mysqli->query($qstring);
    
    if (!$product_created) {
        return "Nie udało się dodać pliku.";
    }
    
    $media_pk = $mysqli->insert_id;
    $target_file = UPLOAD_PATH . $media_pk . "." . $file_ext;

    file_put_contents($target_file, $contents);
    
    return $media_pk;
}

function get_media_of_product($product_pk) {
    $mysqli = get_mysqli();
    $query = "SELECT * FROM Media WHERE product_pk=".$product_pk.";";
    $result = $mysqli->query($query);

    while ($media = $result->fetch_object()) {
        yield $media;
    }
}

function get_url_of_media($media) {
    return "/uploads/".$media->pk.".".$media->file_ext;
}

function get_media_urls_of_product($product_pk) {
    foreach (get_media_of_product($product_pk) as $media) {
        get_url_of_media($media);
    }
}

function get_media($media_pk) {
    $mysqli = get_mysqli();
    $query = "SELECT * FROM Media WHERE pk=".$media_pk.";";
    $result = $mysqli->query($query);

    while ($media = $result->fetch_object()) {
        return $media;
    }
}

function delete_media($media_pk) {
    force_authenticated();
    $mysqli = get_mysqli();
    
    $qstring = "DELETE FROM Media WHERE pk=".$media_pk.";";

    $media_removed = $mysqli->query($qstring);
    
    if (!$media_removed) {
        return "Nie udało się usunąć obrazka.";
    }
    
    return true;
}
?>