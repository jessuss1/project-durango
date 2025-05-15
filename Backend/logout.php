<?php

session_start();
 
$_SESSION = array();

session_destroy();
 

header("location: login_students.php");
exit;

