<?php
include "../../class/user.class.php";
include "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();
$error = "";
if(isset($_SESSION['error']))
    $error = $_SESSION['error'];
include "functions.php";

$error = array();
if($_POST)
{
    $user = new User();

    $password = strip_tags($_POST['password']);
    $passwordCheck = strip_tags($_POST['passwordCheck']);
    $username = trim(strip_tags($_POST['username']));

    // IF USERNAME EMPTY
    if(empty($username))
        array_push($error,"Please fill the username.");

    if(empty($password))
        array_push($error,"Please fill the password.");

    //IF PASSWORD EMPTY
    if(empty($password))
        array_push($error,"Please fill the password verification.");

    //IF PASSWORD EMPTY
    if($password !== $passwordCheck)
        array_push($error,"Password don't match.");

    // IF NO ERROR
    if(count($error) <= 0) {
        // CHECK WHETHER A USER EXISTS
        $connected = already_user($username, $link);
        if ($connected != 0)
        {
            array_push($error, "The username already exists.");
             header('Location:/signup.php');
        }
        else{
            // CREATE ACCOUNT
            $created = create_user($username,$password,$link);
            $_SESSION['user'] = create_user_session($created);
            header('Location:/chat.php');
        }
    }
    else{
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['error'] = $error;
        header('Location:/signup.php');
    }
}

?>