<?php
    class GetUserScore {
        public function getUserScore($id){
            require_once 'DBConnect.php';
            $dbc = new DBConnect();
            $pdo = $dbc->dbConnect();
            $sql = "SELECT user_id, user_score FROM user WHERE user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray=$ps->fetch();
            return $searchArray['user_score'];
        }
    }
?>