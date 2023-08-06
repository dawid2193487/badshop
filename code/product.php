<?php 
include_once "layout/header.php";
include_once "utils/user.php"; 
include_once "utils/product.php"; 
include_once "components/product.php";
?>


<?php render_product_detail(get_product($_GET["pk"])) ?>

<?php include_once "layout/footer.php";?>