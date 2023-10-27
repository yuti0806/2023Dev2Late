<?php
    class UserPost{
        public function userPost($id, $pass){
            require_once 'DBConnect.php';
            $dbc = new DBConnect();
            $pdo = $dbc->dbConnect();
            $sql1 = "SELECT user_id FROM user";
            $ps = $pdo->prepare($sql1);
            $ps->execute();
            $searchArray=$ps->fetchAll();
            foreach($searchArray as $userIdArray){
                if($userIdArray == $id){
                    return false;
                }
            }
            $sql2 = "INSERT user (user_id, user_password, user_score) VALUES (?, ?, 0)";
            $ps = $pdo->prepare($sql2);
            $ps->biadValue(1,$id,PDO::PARAM_STR);
            $ps->bindValue(2,$pass,PDO::PARAM_STR);
            $ps->execute();
            return true;
        }
    }
?>