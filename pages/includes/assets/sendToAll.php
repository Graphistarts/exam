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
    $title = trim(strip_tags($_POST['title']));
    $content = trim(strip_tags($_POST['content']));

    // IF TITLE EMPTY
    if(empty($title))
        array_push($error,"Please fill the username.");

    //IF CONTENT EMPTY
    if(empty($content))
        array_push($error,"Please fill the content.");


    if(count($error) <= 0)
    {
            try{
                $query = "SELECT email FROM MAILING_LIST";
                $preparedStatement = $link->prepare($query);
                $preparedStatement->execute();

                while($user = $preparedStatement->fetch())
                {
                    send_mail($title,$content,$user['email']);
                }
                header("Location:/php/mailinglist/pages/manager.php");
            }catch (PDOException $e) {echo 'Error in DB request: ' . $e->getMessage();}


    }
    else{
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['content'] = $_POST['content'];
        $_SESSION['error'] = $error;
        echo('ERROR');
        //header('Location:../../login.php');
    }

}

?>