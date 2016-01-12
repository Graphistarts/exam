<?php

require_once "../../class/user.class.php";
require_once "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();
require_once "functionsAdmin.php";

if($_POST)
{
$email = trim(strip_tags($_POST['email']));
delete_email($email,$link);
}
else{
    header('Location : login.php');
}
?>