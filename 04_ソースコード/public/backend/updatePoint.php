<?php
// セッション開始
session_start();
// DBmngクラスのインスタンスを生成する
require_once 'DBmng.php';
// PDOの取得
// $_SESSION['pdo'] = $cls->dbConnect();
// セッションにPDOがあるか確認する
if (isset($_SESSION['pdo'])) {
    $pdo = $_SESSION['pdo'];
} else {
    $cls = new DBmng();
    $pdo = $cls->dbConnect();
    // $_SESSION['pdo'] = $pdo;
}

// 点数更新のメソッドを呼び出す
$cls->updateScore($_POST['newscore'], $pdo);

// 更新後に現在のスコアを取得する
$nowScore = $cls->getUserScoreById($_SESSION['user_id'], $pdo);
// json文字列形式にして返す
$rt = array('nowScore' => $nowScore);
echo json_encode($rt);
