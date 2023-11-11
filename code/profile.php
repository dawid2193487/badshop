<?php 
include_once "layout/header.php";
include_once "utils/user.php"; 
include_once "utils/product.php"; 
include_once "components/product.php";
?>

<?php 
    $username = get_user_name($_GET["pk"]);
    $profile = get_profile($_GET["pk"]);
    $products = get_products_of_user($_GET["pk"]);
?>

<h1><?php echo $username ?></h1>
<a href="/messages.php?to=<?php echo $_GET["pk"] ?>">Wyślij wiadomość</a>
<p class="description">
    <?php 
    if ($profile->description == "") {
        echo "<i>[brak opisu]</i>";
    } else {
        echo $profile->description;
    }
    ?>
</p>
<?php if ($_GET["pk"] == get_user_pk()) { ?>
    <a href="/set_description.php">Zmień opis</a>
<?php } ?>

<?php render_product_list($products) ?>

<?php include_once "layout/footer.php";?>