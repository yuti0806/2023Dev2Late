<?php
session_start();

if (empty($_POST['user_id'])) {
      $_SESSION['createError'] = "user idを入力してください";
      header('Location:../test2/newcreate.html');
      exit;
} else if (empty($_POST['user_password'])) {
      $_SESSION['createError'] = "Passwordを入力してください";
      header('Location:../test2/newcreate.html');
      exit;
}

require_once 'DBmng.php';
$cls = new DBmng();
if ($_POST['create']) {
      $cls->userCreation($_POST['user_id'], $_POST['user_password'], null);
      $_SESSION['user_id'] = $_POST['user_id'];
      header('Location:../test2/index.html');
      exit;
}
