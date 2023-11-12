<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LOGOUT</title>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8">

  <!-- css -->
  <link href="../assets/css/loader.css" rel="stylesheet" type="text/css"/>

<body>
  <div class='loader loader-circularSquare'></div>

</body>
</html>


<?php 

// 將 session 清空
unset($_SESSION['username']);

// 登出;
echo '<meta http-equiv=REFRESH CONTENT=1;url=./LOGIN-REGISTER.html>';

 ?>
