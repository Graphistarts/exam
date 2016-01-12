<?php

class Database {

    public function connect()
    {
        try {
            // ASSETS TO CONNECT
        $server ="localhost";
        $port = "";
        $db = "DB_PHP";
        $user = "root";
        $password = "root";
        $charset = "utf8";
        $type = "mysql";

            // REQUEST
        $connect = $type.":host=".$server.$port.";dbname=".$db.";charset=".$charset;

            // CONNECTION
        $link = new PDO($connect, $user, $password);
        return $link;

        } catch (PDOException $e) {echo 'Connection failed: ' . $e->getMessage();}

    }

}

?>