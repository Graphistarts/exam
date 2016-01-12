<?php

if(isset($_SESSION['user']) && ($_SESSION['user']->getIsConnected()) == true)
{
    echo('
<div class="wrapper">
<a class="logout" href="logout.php">Logout</a>
</div>
');
}
else{
    header('Location:login.php');
}
?>