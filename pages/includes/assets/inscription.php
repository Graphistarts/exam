<?php
include "../../class/user.class.php";
include "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();

$error = array();
$notification = array();

include "functions.php";

if($_POST)
{
    if($_POST['check'])
        die('You seem to be a bot.');
    $user = new User();

    // CLEANING EMAIL
    $email = trim(strip_tags($_POST['email']));

    // CHECK WHETHER EMPTY
    if(empty($email))
        array_push($error,"Please enter an email.");
    else{
        // CHECK WHETHER VALID
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
            array_push($error,"Your email is not valid.");
    }

    // IF NO ERROR
    if(count($error) <= 0) {
        // CHECK WHETHER THE SAME EMAIL EXISTS
        $connected = already_email($email, $link);
        if ($connected != 0)
        {
            if($connected['is_activated'] == 0)
                array_push($error, 'The email is waiting to be activated.');
            else
                array_push($error, 'The email is already subscribing.');
            $_SESSION['error'] = $error;

            header('Location:/php/mailinglist/pages/index.php');
            //header('Location:/pages/');
        }
        else{
            $created = create_account($email,$link);
            // send confirmation mail
            send_confirm_mail($email,$link);
            array_push($notification,"An email has been sent to confirm your subscription.");
            $_SESSION['notification'] = $notification;
            header('Location:/php/mailinglist/pages/index.php');
            //header('Location:/pages/');
        }
    }
    // THERE IS AN ERROR
    else{
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['error'] = $error;
        header('Location:/php/mailinglist/pages/index.php');
        //header('Location:/pages/');
    }
}

?>