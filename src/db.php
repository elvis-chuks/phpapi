<?php

    class Connect extends PDO{
        public function __construct(){
            $servername = "localhost";
            $username = "root";
            $password = "@123elvischuks";

            parent::__construct("mysql:host=$servername;dbname=test", $username, $password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        
        }
    }
?>
