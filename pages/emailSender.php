<?php
// CLASSES
require_once "includes/assets/classes.php";
session_start();
$db = new database;
$link = $db->connect();
require_once "includes/assets/checkConnect.php";
require_once "includes/assets/functionsAdmin.php";
require_once "includes/assets/functions.php";

?>
<!DOCTYPE>
<html lang="en-US">
<head>
    <?php include "includes/assets/head.php";?>
    <title>Examen de PHP</title>
</head>
<body>

<?php include "includes/views/header.php"; ?>
<main>
    <a href="manager.php" class="back">Back to manager</a>
    <form method="post" action="includes/assets/sendToAll.php" class="pure-form pure-form-stacked mailToAll">
        <input type="text" name="title" placeholder="Title" value="<?php retrieveValue('title'); ?>"/>
        <textarea name="content" placeholder="Your mail content" value="<?php retrieveValue('content'); ?>"></textarea>
        <input type="hidden" name="check"/>
        <input class="pure-button pure-button-primary" type="submit" value="Send"/>
    </form>
</main>

<?php include "includes/views/footer.php"; ?>
<?php include "includes/assets/foot.php"; ?>
</body>
</html>