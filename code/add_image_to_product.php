<?php 
include_once 'utils/user.php';
include_once 'utils/product.php';
force_authenticated();

if (!isset($_GET["product_id"])) {
    http_response_code(400);
    die("Musisz podać numer oferty.");
}

$product = get_product($_GET["product_id"]);
if (is_null($product)) {
    http_response_code(404);
    die("Nie istnieje taka oferta.");
}

$product_user_pk = $product->user_pk;
if ($product_user_pk != get_user_pk()) {
    http_response_code(403);
    die("Nie masz dostępu do tego zasobu");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/media.php';
    if (isset($_POST["url"])) {
        // using url upload
        $media_pk = create_media_from_url($_GET["product_id"], $_POST["url"]);
    } else {
        // using $_FILES
        $media_pk = create_media($_GET["product_id"]);
    }
    header("Location: /product.php?pk=".$_GET["product_id"]);
    exit();
} else {
    include_once 'layout/header.php'; 
    ?>
    <h1> Dodaj z pliku </h1>
    <form method="post" enctype="multipart/form-data">
        <label for="">
            <span>Obraz:</span>
            <input type="file" name="upload" id="upload">
        </label>
        <br>
        <button type="submit">Dodaj obraz z pliku</button>
    </form>
    <h1> Dodaj z adresu </h1>
    <form method="post" enctype="multipart/form-data">
        <label for="">
            <span>Adres obrazu:</span>
            <input type="url" name="url" id="url">
        </label>
        <br>
        <button type="submit">Dodaj obraz z adresu</button>
    </form>
    <?php 
} 

include_once 'layout/footer.php'; ?>
