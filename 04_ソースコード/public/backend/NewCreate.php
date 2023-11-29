<?php 
session_start();
require_once 'DBmng.php';
$cls = new DBmng();
if($_POST['create']){
$cls->userCreation($_POST['user_id'],$_POST['user_password'],);
$_SESSION['user_id'] = $_POST['user_id'];
header('Location:../html/Top.html');
      exit;
}
?>