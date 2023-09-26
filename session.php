<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./config.php";
require_once "./functions.php";
$dbcon = dbConnect($config);
if ($dbcon){
	//$isActiv = isSessionActive($dbcon);
    if (!($isActiv = isSessionActive($dbcon))){
	sessionExit();
	goBack();
	}
}else {
header("Location: ./ht/404.html");//strike();
}

/*if (!$isActiv){
	header("Location: ./signin.php");
	//redirect
}*/
