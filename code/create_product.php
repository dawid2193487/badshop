<?php 
include_once 'utils/user.php';
force_authenticated();

include_once 'layout/header.php'; ?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/product.php';
    $response = create_product($_POST["title"], $_POST["description"], $_POST["price"]);
    echo($response);
} else {
    ?><form method="post">
        <label for="">
            <span>Tytuł:</span>
            <input type="text" name="title" id="title">
        </label>
        <br>
        <label for="">
            <span>Opis:</span>
            <textarea name="description" id="description"></textarea>
        </label>
        <br>
        <label for="">
            <span>Cena:</span>
            <input type="number" name="price" id="price">
        </label>
        <br>
        <button type="submit">Sprzedawaj!</button>
    </form><?php 
} 

include_once 'layout/footer.php'; ?>
