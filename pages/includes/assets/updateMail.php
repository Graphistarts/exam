<?php

require_once "../../class/user.class.php";
require_once "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();
require_once "functionsAdmin.php";

if($_POST)
{
    $newMail = trim(strip_tags($_POST['nEmail']));
    $previousMail = trim(strip_tags($_POST['pEmail']));
    if(filter_var($newMail, FILTER_VALIDATE_EMAIL)) {
        echo("1");
        return update_email($newMail, $previousMail, $link);
    }
    else{
        return 0;
    }

}
else{
    header('Location : login.php');
}
?>