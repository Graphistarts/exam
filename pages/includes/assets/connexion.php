<?php
require_once "../../class/user.class.php";
require_once "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();
$error = "";
if(isset($_SESSION['error']))
    $error = $_SESSION['error'];
require_once "functions.php";

$user = new User();
$error = array();

if($_POST)
{
    if($_POST['check'])
        die('You seem to be a bot.');

    $password = strip_tags($_POST['password']);
    $username = strip_tags($_POST['username']);

    // IF USERNAME EMPTY
    if(empty($username))
        array_push($error,"Please fill the username.");

    //IF PASSWORD EMPTY
    if(empty($password))
        array_push($error,"Please fill the password.");

    // IF NO ERROR
    if(count($error) <= 0)
    {
        // CHECK WHETHER A USER EXISTS
        $connected = connexion_user($username,$password,$link);
        if($connected == 0)
        {
            array_push($error,"Your username and password don't match.");
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['error'] = $error;
            header('Location:../../login.php');
        }
        else{
            $_SESSION['user'] = create_user_session($connected);
            header('Location:../../manager.php');
        }
    }
    else{
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['error'] = $error;
        header('Location:../../login.php');
    }

}

?>