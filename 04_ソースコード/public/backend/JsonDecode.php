<?php
    session_start();
    $jsonStr = filter_input(INPUT_POST, "json");
    $data = json_decode($jsonStr, true);
    if($data){
        require_once 'DMmng.php';
        $us = new updateScore($data, $_SESSION['pdo']);
    }
?>
