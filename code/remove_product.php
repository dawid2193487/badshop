<?php 
include_once 'utils/user.php';
force_authenticated();

include_once 'layout/header.php'; ?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/product.php';
    $response = remove_product($_POST["pk"]);
    echo($response);
} else {?>
    <h1> Czy na pewno chcesz usunąć ten produkt? </h1>
    <?php
        include_once 'utils/product.php';
        include_once 'components/product.php';
        $product = get_product($_GET["pk"]);
        render_product_preview($product);
    ?>
    <form method="post">
        <input type="hidden" name="pk" id="pk" value="<?php echo $_GET["pk"]?>">
        <button type="submit">Usuń</button>
    </form><?php 
} 

include_once 'layout/footer.php'; ?>
