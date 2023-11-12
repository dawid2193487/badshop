<?php include_once 'utils/media.php'; ?>

<?php function render_product_preview($product) { ?>
    <div class="product">
        <div class="title"><a href="/product.php?pk=<?php echo $product->pk ?>"><?php echo $product->title; ?> </a></div>
        <div class="price">
            <?php echo $product->price; ?> zł
        </div>
        <div class="description">
            <?php echo $product->description ?>
        </div>
        <div class="created-on">
            <?php echo $product->creation_date ?>
        </div>
        <div class="sold-by">
            Sprzedawane przez
            <a href="/profile.php?pk=<?php echo $product->user_pk ?>">
                <?php echo get_user_name($product->user_pk); ?>
            </a>
        </div>
    </div>
<?php } ?>

<?php function render_product_list($products_iter) { 
    // print_r(iterator_to_array($products_iter))
    ?>
    <div class="products"><?php
        foreach($products_iter as $product) {
            render_product_preview($product);
        }
    ?></div>
<?php } ?>

<?php function render_product_detail($product) { 
    $user_pk = get_user_pk();
    $is_owner = $user_pk == $product->user_pk;
?>
    <style>
        .purchase, .remove {
            display: inline-block;
        }
    </style>
    <div class="product-container">
        <div class="product-detail">
            <div class="title"> <?php echo $product->title; ?> </div>
            <div class="submitted-by">
                Sprzedawane przez 
                <a href="/profile.php?pk=<?php echo $product->user_pk ?>">
                    <?php echo get_user_name($product->user_pk); ?>
                </a>
            </div>
            <div class="price">
                <?php echo $product->price; ?> zł
            </div>
            <div class="purchase">
            <form method="GET" action="/purchase.php">
                <input type="hidden" name="pk" id="pk" value="<?php echo $product->pk;?>">
                <button class="button" type="submit">Kup teraz!</button>
            </form>
            </div>
            <div class="remove">
                <?php if ($is_owner) {?>
                    <form method="GET" action="/remove_product.php">
                        <input type="hidden" name="pk" id="pk" value="<?php echo $product->pk;?>">
                        <button class="button" type="submit">Usuń</button>
                    </form>
                <?php } ?>
            </div>
            <div class="gallery">
                <?php 
                    foreach (get_media_of_product($product->pk) as $media) {  ?>
                        <div class="image">
                            <img src="<?php echo get_url_of_media($media); ?>" alt="">
                            <?php 
                                if ($is_owner) {?>
                                    <form method="POST" action="/remove_image.php?media_pk=<?php echo $media->pk; ?>">
                                        <button class="button" type="submit">Usuń</button>
                                    </form>
                                <?php }
                            ?>
                        </div>
                    <?php }
                ?>
                <?php if ($is_owner) {?>
                    <a class="button" href="add_image_to_product.php?product_id=<?php echo $product->pk; ?>">Dodaj obraz</a>
                <?php } ?>
            </div>
            <div class="description">
                <?php echo $product->description; ?>
            </div>
            
        </div>
    </div>
<?php } ?>