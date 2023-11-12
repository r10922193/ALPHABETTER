<?php session_start(); 

$DBHOST = "140.118.9.128";
//phpMyAdmin路徑
$DBUSER = "test";
//phpMyAdmin帳號
$DBPASSWD = "123456";
//phpMyAdmin密碼

//連結至MySQL使用者資料庫（資料庫路徑，帳號，密碼）
$conn = new mysqli($DBHOST, $DBUSER, $DBPASSWD, $_SESSION['username']);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

//設定編碼連線，防止中文字體亂碼
mysqli_query($conn, "SET NAMES 'utf8'");

?>