<?php 
include_once "layout/header.php";
include_once "utils/user.php"; 
include_once "utils/product.php"; 
include_once "components/product.php";
?>

Witaj <?php echo get_user_name(get_user_pk()); ?>

<h1>Oferty</h1>
<?php render_product_list(get_products()) ?>

<?php include_once "layout/footer.php";?>