<?php
session_start();
$_SESSION = array();
session_destroy();

header('Location:../test/login.html');
exit;
