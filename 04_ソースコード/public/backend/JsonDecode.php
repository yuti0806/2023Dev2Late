<?php
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if($data){
        require_once 'DMmng.php';
        $us = new updateScore($data, $_SESSION['pdo']);
    }
?>