<?php 
include_once 'utils/user.php';
force_authenticated();

include_once 'layout/header.php'; ?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/product.php';
    $product = get_product($_POST["pk"]);
    $payee = $product->user_pk;
    $value = $product->price;
    $payer = get_user_pk();
    if (get_balance($payer) < $value) {
        echo ("Masz za mało środków na koncie.");
    } else {
        charge_user($payer, $value);
        charge_user($payee, -$value);
        echo ("Produkt kupiony. Pobrano ".$value."zł z twojego konta");
    }

} else {?>
    <h1> Czy na pewno chcesz kupić ten produkt? </h1>
    <?php
        include_once 'utils/product.php';
        include_once 'components/product.php';
        $product = get_product($_GET["pk"]);
        render_product_preview($product);
    ?>
    <form method="post">
        <input type="hidden" name="pk" id="pk" value="<?php echo $_GET["pk"]?>">
        <button type="submit">Kup</button>
    </form><?php 
} 

include_once 'layout/footer.php'; ?>
