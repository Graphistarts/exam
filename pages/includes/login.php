<?php
    // CLASSES
require_once "includes/assets/classes.php";
    session_start();
    $db = new database;
    $link = $db->connect();
    $error = "";
        if(isset($_SESSION['error']))
            $error = $_SESSION['error'];

require_once "includes/assets/functions.php";
?>
<!DOCTYPE>
<html lang="en-US">
	<head>
        <?php include "includes/assets/head.php";?>

        <link rel="stylesheet" type="text/css" href="../css/pages/login.min.css"/>
		<title>Examen de PHP</title>
	</head>
	<body>

    <?php include "includes/views/header.php"; ?>
        <main>
            <div class="container-form">
                    <div class="wrapper">
                        <h1>Sign in</h1>
                            <form method="post" action="includes/assets/connexion.php" class="pure-form pure-form-stacked">
                                <input type="text" name="username" placeholder="Username" value="<?php retrieveValue('username'); ?>"/>
                                <input type="password" name="password" placeholder="Password" value=""/>
                                <input type="hidden" name="check"/>
                                <input class="pure-button pure-button-primary" type="submit" value="Sign In"/>
                            </form>
                            <div class="error">
                              <?php  display_errors($error); ?>
                            </div>
                    </div>
            </div>
        </main>

    <?php include "includes/views/footer.php"; ?>
    <?php include "includes/assets/foot.php"; ?>
    </body>
</html>