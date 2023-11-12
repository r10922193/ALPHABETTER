<?php include("../filterSystem/personaldb_connect.inc.php"); 
error_reporting(E_ALL^E_NOTICE); 

	
	$time = $_SESSION['quizTime'];
  $score = 0;

  // 把解答寫入資料庫
    $ans1 = $_POST["pro1"];
    if ($ans1==1) {$score++;}
    $quiz1 = "UPDATE `quiz` SET `result` = '$ans1'  WHERE `quizNum` = '1' AND `startTime` = '$time'";
   	$rs1 = mysqli_query($conn, $quiz1);
    $ans2 = $_POST["pro2"];

    if ($ans2==1) {$score++;}
    $quiz2 = "UPDATE `quiz` SET `result` = '$ans2'  WHERE `quizNum` = '2' AND `startTime` = '$time'";
   	$rs2 = mysqli_query($conn, $quiz2);
    $ans3 = $_POST["pro3"];

    if ($ans3==1) {$score++;}
    $quiz3 = "UPDATE `quiz` SET `result` = '$ans3'  WHERE `quizNum` = '3' AND `startTime` = '$time'";
   	$rs3 = mysqli_query($conn, $quiz3);
    $ans4 = $_POST["pro4"];

    if ($ans4==1) {$score++;}
    $quiz4 = "UPDATE `quiz` SET `result` = '$ans4'  WHERE `quizNum` = '4' AND `startTime` = '$time'";
   	$rs4 = mysqli_query($conn, $quiz4);
    $ans5 = $_POST["pro5"];

    if ($ans5==1) {$score++;}
    $quiz5 = "UPDATE `quiz` SET `result` = '$ans5'  WHERE `quizNum` = '5' AND `startTime` = '$time'";
   	$rs5 = mysqli_query($conn, $quiz5);
    $ans6 = $_POST["pro6"];

    if ($ans6==1) {$score++;}
    $quiz6 = "UPDATE `quiz` SET `result` = '$ans6'  WHERE `quizNum` = '6' AND `startTime` = '$time'";
   	$rs6 = mysqli_query($conn, $quiz6);
    $ans7 = $_POST["pro7"];

    if ($ans7==1) {$score++;}
    $quiz7 = "UPDATE `quiz` SET `result` = '$ans7'  WHERE `quizNum` = '7' AND `startTime` = '$time'";
   	$rs7 = mysqli_query($conn, $quiz7);
    $ans8 = $_POST["pro8"];

    if ($ans8==1) {$score++;}
    $quiz8 = "UPDATE `quiz` SET `result` = '$ans8'  WHERE `quizNum` = '8' AND `startTime` = '$time'";
   	$rs8 = mysqli_query($conn, $quiz8);
    $ans9 = $_POST["pro9"];

    if ($ans9==1) {$score++;}
    $quiz9 = "UPDATE `quiz` SET `result` = '$ans9'  WHERE `quizNum` = '9' AND `startTime` = '$time'";
   	$rs9 = mysqli_query($conn, $quiz9);
    $ans10 = $_POST["pro10"];

    if ($ans10==1) {$score++;}
    $quiz10 = "UPDATE `quiz` SET `result` = '$ans10'  WHERE `quizNum` = '10' AND `startTime` = '$time'";
    $rs10 = mysqli_query($conn, $quiz10);
     
  // 計算分數
  $score = 10*$score;

  // 顯示答案
  $sqlMax = "SELECT MAX(learnNum) FROM `learn`";
  $rsMax = mysqli_query($conn, $sqlMax);
  $row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
  $max = $row[0];
  $opt = $_SESSION['opt'];

  // 取得此次遊戲單字存入$words陣列
  $sqlWord = "SELECT word, ch, en FROM `learn` WHERE learnNum = $max ORDER BY RAND()";
  $rsWord = mysqli_query($conn, $sqlWord);
  $words = array();
  $chs = array();
  $ens = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsWord, MYSQLI_NUM)) {
      $words[$id] = $row[0];
      $chs[$id] = $row[1];
      $ens[$id] = $row[2];
      $id++;
  }
  
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>TEST RESULT</title>
  <link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>	
	<link href="../assets/css/test/test-result.css" rel="stylesheet" type="text/css"/>
	<link href="../assets/css/ionicons.min.css" rel="stylesheet"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif+TC&dision-ios-play=swap" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</head>

<body>
	<div class="wrapper">
		<!----- Header ----->
		<header>
			<div class="header-area transparent-bar" id="navmenu">
				<div class="container">
					<div data-toggle="collapse" data-target="#navmenu" data-offset="0">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-5 col-5">
							<div class="header-back same-style">
                <a href="../learnSystem/home.html" class="btn btn-success">↩ BACK</a>
              </div>
							<div class="sticky-logo">
								<a href="../learnSystem/home.html"><img src="../assets/images/logo/logo60.png" alt=""></a>
							</div>
							<div class="logo-small-device">
								<a href="../learnSystem/home.html"><img src="../assets/images/logo/logo80.png"></a>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 d-none d-md-block">
							<div class="logo-menu-wrapper text-center">
								<div class="logo">
									<a href="../learnSystem/home.html"><img src="../assets/images/logo/logo80.png" alt=""/></a>
								</div>
							</div>
						</div>
						<!-- Header Side Icon -->
						<div class="col-lg-2 col-md-2 col-sm-7 col-7">
							<div class="header-site-icon">
							    <div class="header-user same-style">
                    <a href="#"><i class="#"></i></a>
                  </div>
                  <div class="header-signout same-style">
                    <button class="sidebar-trigger-signout">										 
									    <a href="../loginSystem/logout.php"><i class="ion-log-out"></i></a>
                    </button>
                  </div>
              </div>
            </div>
					</div>
				</div>
			</div>
    </header>
    
		<!----- Section Result ----->
    <section class="section-result">
			<div class="jumbotron jumbotron-fluid d-flex align-items-center">
        <div class="container-fluid content">
          <h1>Your Score</h1>
          <div class="score"><h4><?php echo $score; ?>%</h4></div> 
            <div id="modalBtn" class="btn answer">Show Answer</div>
              <div id="myModal" class="modal">
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <?php 
                    for ($i=0; $i < 10; $i++){ 
                      //echo "<p>".$words[$i]."   ".$chs[$i]."<br>".$ens[$i]."</p>";
                      echo "<h5 class=\"word\">".$words[$i]."</h5>";
                      echo "<h5 class=\"ch\">".$chs[$i]."</h5>";
                      echo "<h5 class=\"en\">".$ens[$i]."</h5>"; } 
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </secction>


  </div>
  <script src="../assets/js/modal.js"></script>   
  <script src="../assets/js/block.js"></script>       

</body>
</html>