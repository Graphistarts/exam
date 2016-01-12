<?php
    // CLASSES
    require_once "includes/assets/classes.php";
    session_start();
    $db = new database;
    $link = $db->connect();
    $error ="";
    if(isset($_SESSION['error']))
        $error = $_SESSION['error'];

    $notification = "";
    if(isset($_SESSION['notification']))

        $notification = $_SESSION['notification'];

    require_once "includes/assets/functions.php";
?>
<!DOCTYPE>
<html lang="en-US">
	<head>
        <?php include "includes/assets/head.php";?>

        <link rel="stylesheet" type="text/css" href="../css/pages/login.min.css"/>
		<title>Mailinglist</title>
	</head>
	<body>

    <?php include "includes/views/header.php"; ?>
        <main>
            <div class="notifications">
                <?php  display_notification($notification); ?>
            </div>
            <div class="container-form">
                <form action="includes/assets/inscription.php" method="POST" class="pure-form pure-form-stacked">
                    <div class="wrapper">
                        <h1>Subscribe</h1>
                            <form method="post" action="index.php">
                                <input type="email" name="email" placeholder="Your email"/>
                                <input type="hidden" name="check"/>
                                <input class="pure-button pure-button-primary" type="submit" value="Subscribe"/>
                            </form>
                            <div class="error">
                              <?php  display_errors($error); ?>
                            </div>
                    </div>
                </form>
            </div>
        </main>

    <?php include "includes/views/footer.php"; ?>
    <?php include "includes/assets/foot.php"; ?>
    </body>
</html>