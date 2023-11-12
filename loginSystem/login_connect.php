<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>CONNECT</title>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">

  <!-- css -->
  <link href="../assets/css/loader.css" rel="stylesheet" type="text/css"/>

<body>
  <div class='loader loader-circularSquare'></div>

</body>
</html>

<!----- PHP ----->
<?php include("./mysql_connect.inc.php"); //連接資料庫

$id = $_POST['id'];
$pw = $_POST['pw'];

// 搜尋資料庫內的資料
$sql = "SELECT * FROM `users` where id = '$id'";
$result = mysqli_query($conn, $sql);
$row = @mysqli_fetch_row($result);

// 判斷帳號與密碼是否為空值 null
// MySQL資料庫裡是否已有該使用者 row[1] == pw
if($id != null && $pw != null && $row[0] == $id && $row[1] == $pw){

  // 將帳號寫入session，方便驗證使用者身份
  $_SESSION['username'] = $id;

  // echo '成功登入!';
  echo '<meta http-equiv=REFRESH CONTENT=1;url=./filter-chosen.php>';

}else{
  
  // echo '登入失敗!';
  echo '<meta http-equiv=REFRESH CONTENT=1;url=./LOGIN-REGISTER.html>';

}

// 關閉連線
mysqli_close($conn);

?>