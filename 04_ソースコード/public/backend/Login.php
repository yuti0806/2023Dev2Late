<?php
session_start();
require_once 'DBmng.php';
$cls = new DBmng();
if (empty($_POST['user_id'])) {
  $_SESSION['loginError'] = "user idを入力してください";
  header('Location:../test2/login.html');
  exit;
} else if (empty($_POST['user_password'])) {
  $_SESSION['loginError'] = "Passwordを入力してください";
  header('Location:../test2/login.html');
  exit;
}
$searchArray = $cls->getUserTblByIdPass($_POST['user_id'], $_POST['user_password'], null);
if (empty($searchArray)) {
  $_SESSION['loginError'] = "user idが存在しません";
  header('Location:../test2/login.html');
  exit;
}
foreach ($searchArray as $row) {
  if ($_POST['user_password'] == $row['user_password']) {
    $_SESSION['user_id'] = $row['user_id'];
    header('Location:../test2/index.html');
    $cls->getUserScoreById($_POST['user_id'], $pdo);
    exit;
  } else {
    $_SESSION['loginError'] = "パスワードが正しくありません";
    header('Location:../test2/login.html');
    exit;
  }
}
