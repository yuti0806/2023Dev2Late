<?php
require_once(__DIR__ . '/Setting.php');
class DBmng
{
    // private $DBhost = Setting::$DBhost;
    // private $DBname = Setting::$DBname;
    // private $DBuser = Setting::$DBuser;
    // private $DBpass = Setting::$DBpass;

    // データベースに接続してPDOインスタンスを生成する関数
    public function dbConnect()
    {
        require_once 'Setting.php';
        $pdo = new PDO(
            "mysql:host=" . Setting::$DBhost . ";dbname=" . Setting::$DBname . ";charset=utf8",
            Setting::$DBuser,
            Setting::$DBpass
        );
        // テスト用 $pdo = new PDO('mysql:host=localhost;dbname=LAA1418747-devlate;charset=utf8','root','root');
        return $pdo;
    }

    // $pdo = $this->dbConnect();

    // スコア取得
    public function getUserScoreById($id)
    {
        $pdo = $this->dbConnect();
        $sql = "SELECT user_id, user_score FROM user WHERE user_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $id, PDO::PARAM_INT);
        $ps->execute();
        $searchArray = $ps->fetch();
        return $searchArray['user_score'];
    }

    // スコア更新
    public function updateScore($new_score)
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $now_score = $this->getUserScoreById($_SESSION['user_id']);
            if ($new_score > $now_score) {
                $pdo = $this->dbConnect();
                $sql = "UPDATE user SET user_score = ? WHERE user_id = ?";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $new_score, PDO::PARAM_INT);
                $ps->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
                $ps->execute();
            }
        }
    }

    // 新規ユーザー登録
    public function userCreation($id, $pass)
    {
        $pdo = $this->dbConnect();
        // 既存のIDと重複していないかチェックする
        $sql1 = "SELECT user_id FROM user";
        $ps = $pdo->prepare($sql1);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        foreach ($searchArray as $userIdArray) {
            if ($userIdArray == $id) {
                return false;
            }
        }
        // 重複していなければ登録する処理を行う
        $sql2 = "INSERT user (user_id, user_password, user_score) VALUES (?, ?, 0)";
        $ps = $pdo->prepare($sql2);
        $ps->bindValue(1, $id, PDO::PARAM_STR);
        $ps->bindValue(2, $pass, PDO::PARAM_STR);
        $ps->execute();
        return true;
    }
}
