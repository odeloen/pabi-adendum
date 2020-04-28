<?php
session_start();
include_once("config/function.php");
extract($_POST); 
$url = "ws_tes.php";
// echo $url; exit();
$data = ws($url);
echo $data;exit(); 
?>