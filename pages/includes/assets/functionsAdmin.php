<?php

function get_all_mails($link){
    try{
        $query = "SELECT * FROM MAILING_LIST";
        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute();
        while($result = $preparedStatement->fetch())
        {
           display_user($result);
        }
    }catch (PDOException $e) {echo 'Error in DB request: ' . $e->getMessage();}
}

/**
 * @param $result
 * DISPLAY A USER IN THE MANAGEMENT PAGE
 */
function display_user($result)
{
    echo('<li>

            <input class="test" type="text" value="'.$result['email'].'"/>
            <span class="'.is_email_validated($result['is_activated']).'"></span>
            <button class="delete" value="test">Delete</button>
        </li>');
}


function delete_email($email,$link){
    try{
        $query = "DELETE FROM MAILING_LIST WHERE email=:email";
        $params = array(
            ":email" => $email
        );

        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute($params);
    }catch (PDOException $e) {echo 'Error in DB request: ' . $e->getMessage();}
}
function is_email_validated($valid){
    if(!($valid))
        return('notValidMail');
    else
        return('validMail');
}


function add_email($email,$link)
{
    $is_activated = 1;
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

function update_email($email,$previousMail,$link)
{
    try {
        $query = "UPDATE MAILING_LIST
                  SET email=:email
                  WHERE email=:previousMail";
        $params = array(
            ":email" => $email,
            ":previousMail" => $previousMail
        );

        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute($params);
        return 1;
    } catch (PDOException $e) {
        echo 'Error in DB request: ' . $e->getMessage();
        return 0;
    }
}


?>