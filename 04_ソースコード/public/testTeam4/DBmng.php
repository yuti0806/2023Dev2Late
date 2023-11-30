<?php
class DBmng
{
    public function dbConnect()
    {
        // 環境にあわせてかえること
        $db_hostname = "mysql219.phy.lolipop.lan";
        $db_name = "LAA1563424-tetrisdb";
        $db_user_name = "LAA1563424";
        $db_password = "A2gxAdmYNxUCDe7";
        $pdo = new PDO("mysql:host={$db_hostname};dbname={$db_name};charset=utf8", $db_user_name, $db_password);
        return $pdo;
    }

    public function getRandomIds($pdo, $num)
    {
        if ($pdo == null) {
            $pdo = $this->dbConnect();
        }

        $sql = "SELECT id FROM questions ORDER BY RAND() LIMIT " . $num;
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        return $searchArray;
    }
    // 指定された$idsの問題を取得する
    public function getQuestionsByIds($pdo, $ids)
    {
        if ($pdo == null) {
            $pdo = $this->dbConnect();
        }

        $sql = "SELECT * FROM questions WHERE id = ?";
        $ps = $pdo->prepare($sql);
        $questions = array();
        $questionIds = array();
        foreach ($ids as $id) {
            $ps->bindValue($id, PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetch();
            $questions[] = $searchArray;
            $questionIds[] = $id;
        }
        // $questions = array();
        // foreach ($ids as $id) {
        //     $questions[] = $id;
        // }
        return $questions;
        // return $questionIds;
    }
}
