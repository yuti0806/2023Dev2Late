<?php
    class UpdateScore {
        public function updateScore($new_score){
            session_start();
            //try{
                if(isset($_SESSION['user_id'])){
                    require_once 'GetUserScore.php';
                    $gus = new GetUserScore();
                    $now_score = $gus->getUserScore($_SESSION['user_id']);
                    if($new_score > $now_score){
                        require_once 'DBConnect.php';
                        $dbc = new DBConnect();
                        $pdo = $dbc->dbConnect();
                        $sql = "UPDATE user SET user_score = ? WHERE user_id = ?";
                        $ps = $pdo->prepare($sql);
                        $ps->bindValue(1,$new_score,PDO::PARAM_INT);
                        $ps->bindValue(2,$_SESSION['user_id'],PDO::PARAM_INT);
                        $ps->execute();
                    }
                //}else{
                //    throw new Exception("セッションエラー");
                //}
            //}catch(Exception $e){
            //    echo $e->getMessage();
            }
        }
    }
?>