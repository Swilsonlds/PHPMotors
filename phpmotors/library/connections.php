<?php
    function createConnection(){
        $server = '127.0.0.1';
        $dbname= 'phpmotors';
        $username = 'iClient';
        $password = 'M_e6l!cULqR6DMF1';
        $dsn = 'mysql:host='.$server.';dbname='.$dbname;
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        // Create the actual connection object and assign it to a variable
        try {
            $link = new PDO($dsn, $username, $password, $options);
            return $link;
        } catch(PDOException $e) {
            header('Location: /phpmotors/500.php');
            exit;
        }
    }
?>