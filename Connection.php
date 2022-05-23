<?php

    class Connection
    {
        function getNewConnection()
        {
            $db = new mysqli("localhost", "root", "", "lvr");
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            } 
            return $db;
        }
    }

?>