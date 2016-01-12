<?php


function already_user($username,$link){
    $query = "SELECT * FROM user WHERE username= :username";
    $params = array(
        ":username" => $username
    );

    $preparedStatement = $link->prepare($query);
    $preparedStatement->execute($params);
    $result = $preparedStatement->fetch();
    if($result)
        return 1;
    else
        return 0;
}

function create_user($username,$password,$link){
    $encryptedPassword = hash("sha512", $password);
    $query = "INSERT INTO user (username,password) VALUES(:username,:password)";
    $params = array(
        ":username" => $username,
        ":password" => $encryptedPassword
    );

    $preparedStatement = $link->prepare($query);
    $preparedStatement->execute($params);
    $user = ['username'=>$username,'is_admin'=>0];
    return $user;
}


// NEW

function retrieveValue($which){
    if(isset($_SESSION[$which]))
        echo($_SESSION[$which]);
    return;

}

function send_mail($title,$content,$email){

    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: admin@kevinkevers.be' . "\r\n";
    $content .= "<a href='http://www.kevinkevers.be/php/mailinglist/pages/includes/assets/unsubscription.php?account=".$email."'>unsubscribe</a>";

    mail($email,$title,$content,$headers);

}
function send_confirm_mail($email){
    $content = "We received an application for subscribing to the newsletter : ".$email."\n. However, you must confirm your email before getting newsletters. <a href='http://www.kevinkevers.be/php/mailinglist/pages/includes/assets/confirmEmail.php?account=".$email."'>Confirm my email</a>";
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: confirmation@kevinkevers.be' . "\r\n";
    $subject = "Reset your account password";


    mail($email,$subject,$content,$headers);
}

function create_account($email,$link)
{
    $is_activated = 0;
    try {
        $query = "INSERT INTO MAILING_LIST (email,is_activated) VALUES(:email,$is_activated)";
        $params = array(
            ":email" => $email,
        );

        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute($params);
        return 1;
    } catch (PDOException $e) {
        echo 'Error in DB request: ' . $e->getMessage();
        return 0;
    }
}



function already_email($email,$link)
{
    try {
        $query = "SELECT * FROM MAILING_LIST WHERE email= :email";
        $params = array(
            ":email" => $email
        );

        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute($params);
        $result = $preparedStatement->fetch();
        if ($result)
            return $result;
        else
            return 0;
    } catch (PDOException $e) {
        echo 'Error in DB request: ' . $e->getMessage();
    }
}

function create_user_session($values){
    $user = new User;
    $user->setIsConnected(true);
    $user->setUsername($values['username']);
    $user->setIsAdmin($values['is_admin']);
    return $user;
}

function connexion_user($username,$password,$link){
    try{
        $query = "SELECT * FROM user WHERE username= :username";
        $params = array(
            ":username" => $username
        );

        $encryptedPassword = hash("sha512", $password);
        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute($params);
        $result = $preparedStatement->fetch();
        if($result)
        {
            if($encryptedPassword != $result['password'])
                return 0;
            return $result;
        }
        else
            return 0;
    }catch (PDOException $e) {echo 'Error in DB request: ' . $e->getMessage();}
}

    // DISPLAY ERROR[]
    function display_errors($error){
        if(!(empty($error)))
            for($i = 0 ; $i < count($error); $i ++)
                echo("<p>".$error[$i]."</p>");
        unset($_SESSION['error']);
    }

function display_notification($notif){
    if(!(empty($notif)))
        for($i = 0 ; $i < count($notif); $i ++)
            echo("<p>".$notif[$i]."</p>");
    unset($_SESSION['notification']);
}


?>