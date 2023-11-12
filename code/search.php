<?php 
include_once "layout/header.php";
include_once "utils/user.php"; 
include_once "utils/product.php"; 
include_once "components/product.php";
?>

<h1>Odnalezione oferty</h1>
<?php render_product_list(get_products_search($_GET["q"])) ?>

<?php include_once "layout/footer.php";?>