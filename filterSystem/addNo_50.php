<?php include("./personaldb_connect.inc.php");

// 取得單字
$ids = $_POST['word'];
$init = $_SESSION['init'];

// 讀取該筆單字資料
$sql = "SELECT * FROM `voc` WHERE word = '{$ids}'";
$search = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($search, MYSQLI_NUM);
$word = $row[0];
$ch = $row[1];	
$en = $row[2];

// 將單字移至 no 資料庫
$add = "INSERT INTO `no` (`word`, `ch`, `en`) VALUES ('$word', '$ch', '$en')";
$rs = mysqli_query($conn, $add);

// 刪除 voc 內已移動的單字
$sqlDel = "DELETE FROM `voc` WHERE word = '$word'";

// 判斷單字數量是否達50題
$yes = "SELECT * FROM `yes`";
$rs1 = mysqli_query($conn, $yes);
$no = "SELECT * FROM `no`";
$rs2 = mysqli_query($conn, $no);
$num = mysqli_num_rows($rs1)+mysqli_num_rows($rs2);

if(($num - $init) < 50){
	Header("Location: ./filter_50.php");
}else{
	Header("Location: ../learnSystem/home.html");
}

if ($conn->query($sqlDel) === TRUE){
    echo "Record deleted successfully";
}else{
    echo "Error deleting record: " . $conn->error;
}

// 關閉連線
mysqli_close($conn);

?>