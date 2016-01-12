<?php
$error = "";
if(isset($_SESSION['error']))
    $error = $_SESSION['error'];
if(isset($_SESSION['user']) && ($_SESSION['user']->getIsConnected()) == true)
{
    header('Location:chat.php');
}
?>