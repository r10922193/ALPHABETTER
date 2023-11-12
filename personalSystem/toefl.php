<?php session_start(); 
include("../loginSystem/mysql_connect.inc.php");

    $id = $_SESSION['username'];
    
	// clear 5 tables
	$delyes = "DELETE FROM $id.yes";
	if($conn->query($delyes) === TRUE){
    }else{
        echo "Error deleting record: " . $conn->error;
    }

    $delno = "DELETE FROM $id.no";
	if($conn->query($delno) === TRUE){
    }else{
        echo "Error deleting record: " . $conn->error;
    }

    $delvoc = "DELETE FROM $id.voc";
	if($conn->query($delvoc) === TRUE){
    }else{
        echo "Error deleting record: " . $conn->error;
    }

    $dellearn = "DELETE FROM $id.learn";
	if($conn->query($dellearn) === TRUE){
    }else{
        echo "Error deleting record: " . $conn->error;
    }
    
    $delquiz = "DELETE FROM $id.quiz";
	if($conn->query($delquiz) === TRUE){
    }else{
        echo "Error deleting record: " . $conn->error;
    }

    // 匯入單字
    $insertVoc = "INSERT $id.voc SELECT * FROM test.toefl";
    if($conn->query($insertVoc) === TRUE){
        echo "Update vocabulary successfully! <br>";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=./wordlist-chosen.html>';
    }else{
        echo "Error insert voc: " . $conn->error;
        echo '單字匯入失敗!<br>';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=./wordlist-chosen.html>';
    }
    
?>