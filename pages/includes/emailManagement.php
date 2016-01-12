<?php
// CLASSES
require_once "includes/assets/classes.php";
session_start();
$db = new database;
$link = $db->connect();
require_once "includes/assets/checkConnect.php";
require_once "includes/assets/functionsAdmin.php";

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
    <form action="emailManagement.php" method="post" class="pure-form pure-form-stacked management">
        <ul>
            <?php get_all_mails($link); ?>

        </ul>
        <div class="addEmail">
            <input type="email" placeholder="Mail to add" value=""/>
            <button class="addEmail">+ add an email</button>
        </div>
        <p class="error"></p>
    </form>
</main>

<?php include "includes/views/footer.php"; ?>
<?php include "includes/assets/foot.php"; ?>
</body>
</html>