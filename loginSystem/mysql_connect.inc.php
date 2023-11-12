
<!-- 建立MySQL資料庫連線 -->
<?php

$DBHOST = "140.118.9.128";
// phpMyAdmin路徑
$DBNAME = "test";
// 資料庫名稱
$DBUSER = "test";
// phpMyAdmin帳號
$DBPASSWD = "123456";
// phpMyAdmin密碼

// 連結至MySQL使用者資料庫（資料庫路徑，帳號，密碼）
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD);

if(empty($conn)){
	print mysqli_error($conn);
	die ("無法連結資料庫");
	exit;
}

// 選取資料庫（資料庫名稱）
if(!mysqli_select_db($conn, $DBNAME)){
	die ("無法選擇資料庫");
}

// 設定編碼連線，防止中文字體亂碼
mysqli_query($conn, "SET NAMES 'utf8'");

?>