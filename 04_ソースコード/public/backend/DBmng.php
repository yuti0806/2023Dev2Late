<?php
    class DBmng{
        public function dbConnect(){
            $pdo = new PDO('mysql:host=218.phy.lolipop.lan;dbname=LAA1418747-devlate;charset=utf8','root','DevLate');
            // テスト用 $pdo = new PDO('mysql:host=localhost;dbname=LAA1418747-devlate;charset=utf8','root','root');
            return $pdo;
        }

//      $pdo = $this->dbConnect();

        public function getUserScore($id){
            $pdo = $this->dbConnect();
            $sql = "SELECT user_id, user_score FROM user WHERE user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray=$ps->fetch();
            return $searchArray['user_score'];
        }

        public function updateScore($new_score){
            session_start();
            //try{
                if(isset($_SESSION['user_id'])){
                    require_once 'GetUserScore.php';
                    $gus = new GetUserScore();
                    $now_score = $gus->getUserScore($_SESSION['user_id']);
                    if($new_score > $now_score){
                        $pdo = $this->dbConnect();
                        $sql = "UPDATE user SET user_score = ? WHERE user_id = ?";
                        $ps = $pdo->prepare($sql);
                        $ps->bindValue(1,$new_score,PDO::PARAM_INT);
                        $ps->bindValue(2,$_SESSION['user_id'],PDO::PARAM_STR);
                        $ps->execute();
                    }
                //}else{
                //    throw new Exception("セッションエラー");
                //}
            //}catch(Exception $e){
            //    echo $e->getMessage();
            }
        }

        public function userCreation($id, $pass){
            $pdo = $this->dbConnect();
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