<?php
class DBmng
{
    public function dbConnect()
    {
        // 環境にあわせてかえること
        $db_hostname = "mysql216.phy.lolipop.lan";
        $db_name = "AA1417875-team4";
        $db_user_name = "LAA1417875";
        $db_password = "team4";
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
        $ids = array();
        foreach ($searchArray as $record) {
            $ids[] = $record['id'];
        }
        return $ids;
    }
    // 指定された$idsの問題を取得する
    public function getQuestionsByIds($pdo, $ids)
    {
        if ($pdo == null) {
            $pdo = $this->dbConnect();
        }

        $sql = "SELECT * FROM questions WHERE id = :id";
        $ps = $pdo->prepare($sql);
        $questions = array();
        $questionIds = array();
        foreach ($ids as $id) {
            $ps->bindValue(':id', $id, PDO::PARAM_INT);
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
