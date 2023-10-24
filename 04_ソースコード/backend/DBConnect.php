<?php
    class Dbconnect{
        public function dbConnect(){
            // $pdo = new PDO('mysql:host=218.phy.lolipop.lan;dbname=LAA1418747-devlate;charset=utf8','root','DevLate');
            $pdo = new PDO('mysql:host=localhost;dbname=LAA1418747-devlate;charset=utf8','root','root');
            return $pdo;
        }
    }
?>