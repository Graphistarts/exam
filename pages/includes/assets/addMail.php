<?php

require_once "../../class/user.class.php";
require_once "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();
require_once "functionsAdmin.php";
require_once "functions.php";

if($_POST && isset($_POST['email']))
{
    $email = trim(strip_tags($_POST['email']));
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        if(already_email($email,$link))
            return 1;
        else{
            add_email($email,$link);
            $result = ['email'=>$email,'is_activated'=>1];
            return display_user($result);
        }
    }
    return 0;
}
else{
    return 0;
    header('Location : login.php');
}
?>