<?php
// CLASSES
require_once "includes/assets/classes.php";
session_start();
$db = new database;
$link = $db->connect();
require_once "includes/assets/checkConnect.php";
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
<main class="wrapper">
    <div class="choiceManager">
        <a class="cta" href="emailManagement.php">Manage emails</a>
        <a class="cta" href="emailSender.php">Sent mail to the list.</a>
    </div>
</main>

<?php include "includes/views/footer.php"; ?>
<?php include "includes/assets/foot.php"; ?>
</body>
</html>