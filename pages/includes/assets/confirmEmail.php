<?php
include "../../class/user.class.php";
include "../../class/database.class.php";
session_start();
$db = new database;
$link = $db->connect();
$notification = "";

include "functions.php";

if($_GET)
{
    if(isset($_GET['account']))
    {
        $email = trim(strip_tags($_GET['account']));
        try{
            $query = "SELECT FROM MAILING_LIST WHERE email=:email";
            $params = array(
                ":email" => $email
            );
            $preparedStatement = $link->prepare($query);
            $preparedStatement->execute($params);
            $result = $preparedStatement->fetch();
            if(count($result) == 1) {
                if ($result['is_activated']) {
                    array_push($notification,'You are already subscribing.');
                    $_SESSION['notification'] = $notification;
                    header('Location:http://www.kevinkevers.be/php/mailinglist/pages/');
                } else {
                    try {
                        $query = "UPDATE MAILING_LIST
                                  SET is_activated=:activated
                                  WHERE email=:email";
                        $params = array(
                            ":email" => $email,
                            ":activated" => 1
                        );

                        $preparedStatement = $link->prepare($query);
                        $preparedStatement->execute($params);

                        array_push($notification,'You are now subscribing.');
                        $_SESSION['notification'] = $notification;
                        header('Location:http://www.kevinkevers.be/php/mailinglist/pages/');
                    } catch (PDOException $e) {echo 'Error in DB request: ' . $e->getMessage();}
                }
            }
            else{
                array_push($notification,'Email not found.');
                $_SESSION['notification'] = $notification;
                header('Location:http://www.kevinkevers.be/php/mailinglist/pages/');
            }


        }catch (PDOException $e) {echo 'Error in DB request: ' . $e->getMessage();}
    }
    else{
        array_push($notification,'No email entered.');
        $_SESSION['notification'] = $notification;
        header('Location:http://www.kevinkevers.be/php/mailinglist/pages/');
    }
}
else{
    array_push($notification,'No email entered.');
    $_SESSION['notification'] = $notification;
    header('Location:http://www.kevinkevers.be/php/mailinglist/pages/');
}


?>