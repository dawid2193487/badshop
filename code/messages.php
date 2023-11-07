<?php 
include_once 'utils/user.php';
force_authenticated();
?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'utils/messages.php';
    $response = send_message($_POST["to"], $_POST["message"]);
    header('Location: /messages.php?to='.$_POST["to"]);
    // echo($response);
} else {
    include_once 'layout/header.php'; 
    include_once 'utils/messages.php';
    $messages = get_messages($_GET["to"]);
    ?>
    <h1>
        Rozmowa z 
        <a href="/profile.php?pk=<?php echo $_GET["to"] ?>">
            <?php echo get_user_name($_GET["to"]) ?>
        </a> 
    </h1>
    <div class="messages">
        <?php foreach($messages as $message) { ?>
            <div class="message <?php if ($message->to_user == $_GET["to"]) { echo "own"; } else { echo "other"; } ?>">
                <div class="content">
                    <?php echo $message->message; ?>
                </div>
                <div class="timestamp">
                    <?php echo $message->creation_date ?>
                </div>
            </div>
        <?php } ?>

    </div>
    <form method="post">
        <input type="hidden" id="to" name="to" value="<?php echo $_GET["to"] ?>">
        <label for="">
            <span>Wiadomość:</span>
            <input type="text" name="message" id="message">
        </label>
        <br>
        <button type="submit">Wyślij</button>
    </form><?php 
} 

include_once 'layout/footer.php'; ?>
