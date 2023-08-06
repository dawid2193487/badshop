<?php 
include_once 'utils/user.php';
include_once 'utils/media.php';
include_once 'utils/product.php';
force_authenticated();

if (!isset($_GET["media_pk"])) {
    http_response_code(400);
    die("Musisz podać numer obrazu.");
}

$media = get_media($_GET["media_pk"]);
if (is_null($media)) {
    http_response_code(404);
    die("Nie istnieje taki obraz.");
}

$product = get_product($media->product_pk);
$product_user_pk = $product->user_pk;
if ($product_user_pk != get_user_pk()) {
    http_response_code(403);
    die("Nie masz dostępu do tego zasobu");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $media_pk = delete_media($_GET["media_pk"]);
    header("Location: /product.php?pk=".$product->pk);
    exit();
} else {
    http_response_code(405);
    die("Ten endpoint akceptuje jedynie POST.");
}
?>
