<?php 
session_start();
require_once 'DBmng.php';
$cls = new DBmng();
if(empty($_POST['user_id'])){
  $_SESSION['loginError'] = "user idを入力してください";
  header('Location:../html/login.html');
  exit;
}else if(empty($_POST['user_password'])){
  $_SESSION['loginError'] = "Passwordを入力してください";
  header('Location:../html/login.html');
  exit;
}
$searchArray = $cls->getUserTblByIdPass($_POST['user_id'],$_POST['user_password'],);
if(empty($searchArray)){
    $_SESSION['loginError'] = "user idが存在しません";
      header('Location:../html/login.html');
      exit;
}
foreach($searchArray as $row){
    if($_POST['user_password'] == $row['user_password']){
        $_SESSION['user_id'] = $row['user_id'];
        header('Location:../html/Top.html');
      exit;
    } else {
      $_SESSION['loginError'] = "パスワードが正しくありません";
      header('Location:../html/login.html');
      exit;
    }
}
?>