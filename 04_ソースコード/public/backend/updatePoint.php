<?php
// セッション開始
session_start();
// DBmngクラスのインスタンスを生成する
require_once 'DBmng.php';
// PDOの取得
// $_SESSION['pdo'] = $cls->dbConnect();
$pdo = $_SESSION['pdo'];
if (is_null($pdo)) {
    $cls = new DBmng();
    $pdo = $cls->dbConnect();
}

// 点数更新のメソッドを呼び出す
$cls->updateScore($_POST['newscore'], $pdo);

// 更新後に現在のスコアを取得する
$now_score = $cls->getUserScoreById($_SESSION['user_id'], $pdo);

echo $now_score;
echo 888;
