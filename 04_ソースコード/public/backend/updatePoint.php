<?php
// セッション開始
session_start();
// DBmngクラスのインスタンスを生成する
require_once 'DBmng.php';
$cls = new DBmng();
// PDOの取得
// $_SESSION['pdo'] = $cls->dbConnect();

// 点数更新のメソッドを呼び出す
$cls->updateScore($_POST['userScore'], $_SESSION['pdo']);

// 更新後に現在のスコアを取得する
$now_score = $cls->getUserScoreById($_SESSION['user_id'], $_SESSION['pdo']);

return $now_score;
