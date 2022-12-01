<?php
    class database{
        private static $scon;

        function createConnection()
        {   
            // Create connection
            $conn = new mysqli("localhost", "root", "root", "schooldb");
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            return $conn;
        }

        public static function connect() 
        {
            if (empty(self::$scon)) {
                 $instance = new database();
                 self::$scon = $instance->createConnection(); 
            }
            return self::$scon; 
        } 
    }
?>