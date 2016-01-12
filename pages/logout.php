<?php
session_start();
unset($_SESSION);
session_destroy();
$_SESSION['notification'] = "Vous êtes déconnecté";
header('Location:login.php');
?>