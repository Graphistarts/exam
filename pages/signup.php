<?php
    // CLASSES
    include "includes/assets/classes.php";
    session_start();
    $db = new database;
    $link = $db->connect();
    include "includes/assets/checkNotConnect.php";
    include "includes/assets/functions.php";
?>

<!DOCTYPE>
<html lang="en-US">
	<head>
        <?php include "includes/assets/head.php"; ?>
        <link rel="stylesheet" type="text/css" href="../css/pages/login.min.css"/>
		<title>Examen de PHP</title>
	</head>
	<body>

    <?php include "includes/views/header.php"; ?>
        <main>
            <div class="container-form">
                <form action="includes/assets/creation.php" method="POST" class="pure-form pure-form-stacked">
                    <div class="wrapper">
                        <h1>Sign up</h1>
                            <form method="post" action="index.php">
                                <input type="text" name="username" placeholder="Username" value="<?php retrieveValue('username'); ?>"/>
                                <input type="password" name="password" placeholder="Password" value=""/>
                                <input type="password" name="passwordCheck" placeholder="Confirm password" value=""/>
                                <input type="hidden" name="check" value="0"/>
                                <input class="pure-button pure-button-primary" type="submit" value="Create an account"/>
                            </form>
                            <p>Already an account ? <a href="index.php">Sign in !</a></p>
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