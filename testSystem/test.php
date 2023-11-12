<?php include("../filterSystem/personaldb_connect.inc.php");
error_reporting(E_ALL^E_NOTICE); 

  // 取得最近一次學習數 $max
  $sqlMax = "SELECT MAX(learnNum) FROM `learn`";
  $rsMax = mysqli_query($conn, $sqlMax);
  $row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
  $max = $row[0];
  $opt = $_POST['option'];
  $_SESSION['opt'] = $opt;

  // 取得此次遊戲單字存入 $words 陣列
  $sqlWord = "SELECT word, en FROM `learn` WHERE learnNum = $opt ORDER BY RAND()";
  $rsWord = mysqli_query($conn, $sqlWord);
  $words = array();
  $ens = array();
  $id = 0;

  // 寫入 quiz 資料表
  $time = date("Y-m-d H:i:s");  //取得時間
  $_SESSION['quizTime'] = $time;
  while($row = mysqli_fetch_array($rsWord, MYSQLI_NUM)){
    $words[$id] = $row[0];
    $ens[$id] = $row[1];
    $quiznum = $id+1;
    $quiz = "INSERT INTO `quiz` (`quizNum`, `word`, `startTime`) VALUES ('$quiznum', '$row[0]', '$time')";
    $rs = mysqli_query($conn, $quiz);
    $id++;
  }

  // 決定正確答案放置於四個選項中的哪一個
  $sqlPro1 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //1
  $rsPro1 = mysqli_query($conn, $sqlPro1);
  $enRadio1 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro1, MYSQLI_NUM)){
    if ($id == 3){  //設置除答案外的三個選項
      break;
    }
    if ($row[0] != $words[0]){  //抽出四個單字，其中最多一個會和題目相同，排除相同之後將不一樣的單字放入
      $enRadio1[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro2 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //2
  $rsPro2 = mysqli_query($conn, $sqlPro2);
  $enRadio2 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro2, MYSQLI_NUM)){
    if ($id == 3) {  
      break;
    }
    if ($row[0] != $words[1]){ 
      $enRadio2[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro3 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //3
  $rsPro3 = mysqli_query($conn, $sqlPro3);
  $enRadio3 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro3, MYSQLI_NUM)){
    if ($id == 3){  
      break;
    }
    if ($row[0] != $words[2]){  
      $enRadio3[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro4 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //4
  $rsPro4 = mysqli_query($conn, $sqlPro4);
  $enRadio4 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro4, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[3]){
      $enRadio4[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro5 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //5
  $rsPro5 = mysqli_query($conn, $sqlPro5);
  $enRadio5 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro5, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[4]){
      $enRadio5[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro6 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //6
  $rsPro6 = mysqli_query($conn, $sqlPro6);
  $enRadio6 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro6, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[5]){ 
      $enRadio6[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro7 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //7
  $rsPro7 = mysqli_query($conn, $sqlPro7);
  $enRadio7 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro7, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[6]){
      $enRadio7[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro8 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //8
  $rsPro8 = mysqli_query($conn, $sqlPro8);
  $enRadio8 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro8, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[7]){
      $enRadio8[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro9 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //9
  $rsPro9 = mysqli_query($conn, $sqlPro9);
  $enRadio9 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro9, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[8]){
      $enRadio9[$id] = $row[0];
      $id++;
    }
  }

  $sqlPro10 = "SELECT word FROM `learn` ORDER BY RAND() LIMIT 4";  //10
  $rsPro10 = mysqli_query($conn, $sqlPro10);
  $enRadio10 = array();
  $id = 0;
  while($row = mysqli_fetch_array($rsPro10, MYSQLI_NUM)){
    if ($id == 3){
      break;
    }
    if ($row[0] != $words[9]){
      $enRadio10[$id] = $row[0];
      $id++;
    }
  }

  $enRadio = array();
  $r = 0;
  // 1
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio1[$j];
    $r++;
  }

  // 2
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio2[$j];
    $r++;
  }

  // 3
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio3[$j];
    $r++;
  }

  // 4
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio4[$j];
    $r++;
  }

  // 5
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio5[$j];
    $r++;
  }

  // 6
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio6[$j];
    $r++;
  }

  // 7
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio7[$j];
    $r++;
  }

  // 8
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio8[$j];
    $r++;
  }

  // 9
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio9[$j];
    $r++;
  }

  // 10
  for ($j=0; $j < 3; $j++) {  
    $enRadio[$r] = $enRadio10[$j];
    $r++;
  }

  // 題目、正解、錯誤設置
  $problem[9][4]="";
  $ansbool[9][4]= NULL;
  $pros = 0;
  for ($i=0; $i < 10 ; $i++){ 
    $int = random_int(1, 4);
    $problem[$i][0] = $ens[$i];  //設置題目
    for ($j=1; $j < 5 ; $j++){ 
      if ($j == $int) {  //設置正確答案
        $problem[$i][$j] = $words[$i];
        $ansbool[$i][$j] = true;
      }else{  //設置錯誤答案
        $problem[$i][$j] = $enRadio[$pros];
        $ansbool[$i][$j] = false;
        $pros++;
      }    
    }
  }

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>TEST</title>
  <link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min2.css" rel="stylesheet"/>
  <link href="../assets/css/test/test.css" rel="stylesheet" type="text/css"/>
	<link href="../assets/css/ionicons.min.css" rel="stylesheet"/>
	<link href="../assets/css/animate.css" rel="stylesheet"/>
  <link href="../assets/css/responsive.css" rel="stylesheet"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet">

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
                <a href="test_option.html" class="btn btn-success">↩ BACK</a>
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
    
		<!----- Section Question ----->
		<section class="section-question">
      <div class="jumbotron jumbotron-fluid d-flex align-items-center">
        <div class="container-fluid content">
          <form method="post" id="regForm" action="./test_result.php">

            <div class="tab">
              <div class="numquestion">
                <h4>1/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[0][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro1" <?php echo "value=\"".$ansbool[0][1]."\""; ?>><?php echo $problem[0][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro1" <?php echo "value=\"".$ansbool[0][2]."\""; ?>><?php echo $problem[0][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro1" <?php echo "value=\"".$ansbool[0][3]."\""; ?>><?php echo $problem[0][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro1" <?php echo "value=\"".$ansbool[0][4]."\""; ?>><?php echo $problem[0][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>
            
            <div class="tab">
              <div class="numquestion">
                <h4>2/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[1][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro2" <?php echo "value=\"".$ansbool[1][1]."\""; ?>><?php echo $problem[1][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro2" <?php echo "value=\"".$ansbool[1][2]."\""; ?>><?php echo $problem[1][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro2" <?php echo "value=\"".$ansbool[1][3]."\""; ?>><?php echo $problem[1][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro2" <?php echo "value=\"".$ansbool[1][4]."\""; ?>><?php echo $problem[1][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>3/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[2][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro3" <?php echo "value=\"".$ansbool[2][1]."\""; ?>><?php echo $problem[2][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro3" <?php echo "value=\"".$ansbool[2][2]."\""; ?>><?php echo $problem[2][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro3" <?php echo "value=\"".$ansbool[2][3]."\""; ?>><?php echo $problem[2][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro3" <?php echo "value=\"".$ansbool[2][4]."\""; ?>><?php echo $problem[2][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>4/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[3][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro4" <?php echo "value=\"".$ansbool[3][1]."\""; ?>><?php echo $problem[3][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro4" <?php echo "value=\"".$ansbool[3][2]."\""; ?>><?php echo $problem[3][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro4" <?php echo "value=\"".$ansbool[3][3]."\""; ?>><?php echo $problem[3][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro4" <?php echo "value=\"".$ansbool[3][4]."\""; ?>><?php echo $problem[3][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>5/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[4][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro5" <?php echo "value=\"".$ansbool[4][1]."\""; ?>><?php echo $problem[4][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro5" <?php echo "value=\"".$ansbool[4][2]."\""; ?>><?php echo $problem[4][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro5" <?php echo "value=\"".$ansbool[4][3]."\""; ?>><?php echo $problem[4][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro5" <?php echo "value=\"".$ansbool[4][4]."\""; ?>><?php echo $problem[4][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>6/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[5][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro6" <?php echo "value=\"".$ansbool[5][1]."\""; ?>><?php echo $problem[5][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro6" <?php echo "value=\"".$ansbool[5][2]."\""; ?>><?php echo $problem[5][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro6" <?php echo "value=\"".$ansbool[5][3]."\""; ?>><?php echo $problem[5][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro6" <?php echo "value=\"".$ansbool[5][4]."\""; ?>><?php echo $problem[5][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>7/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[6][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro7" <?php echo "value=\"".$ansbool[6][1]."\""; ?>><?php echo $problem[6][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro7" <?php echo "value=\"".$ansbool[6][2]."\""; ?>><?php echo $problem[6][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro7" <?php echo "value=\"".$ansbool[6][3]."\""; ?>><?php echo $problem[6][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro7" <?php echo "value=\"".$ansbool[6][4]."\""; ?>><?php echo $problem[6][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>8/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[7][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro8" <?php echo "value=\"".$ansbool[7][1]."\""; ?>><?php echo $problem[7][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro8" <?php echo "value=\"".$ansbool[7][2]."\""; ?>><?php echo $problem[7][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro8" <?php echo "value=\"".$ansbool[7][3]."\""; ?>><?php echo $problem[7][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro8" <?php echo "value=\"".$ansbool[7][4]."\""; ?>><?php echo $problem[7][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>9/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[8][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro9" <?php echo "value=\"".$ansbool[8][1]."\""; ?>><?php echo $problem[8][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro9" <?php echo "value=\"".$ansbool[8][2]."\""; ?>><?php echo $problem[8][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro9" <?php echo "value=\"".$ansbool[8][3]."\""; ?>><?php echo $problem[8][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro9" <?php echo "value=\"".$ansbool[8][4]."\""; ?>><?php echo $problem[8][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>

            <div class="tab">
              <div class="numquestion">
                <h4>10/10</h4>
              </div>
              <div class="question">
                <h2><?php echo $problem[9][0]; ?></h2>
              </div>

              <label class="column">
                <input type="radio" name="pro10" <?php echo "value=\"".$ansbool[9][1]."\""; ?>><?php echo $problem[9][1]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro10" <?php echo "value=\"".$ansbool[9][2]."\""; ?>><?php echo $problem[9][2]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro10" <?php echo "value=\"".$ansbool[9][3]."\""; ?>><?php echo $problem[9][3]; ?>
                  <span class="checkmark"></span>
              </label>

              <label class="column">
                <input type="radio" name="pro10" <?php echo "value=\"".$ansbool[9][4]."\""; ?>><?php echo $problem[9][4]; ?>
                  <span class="checkmark"></span>
              </label>
            </div>


            <!-- Section Number Step Button -->
            <div class="step_btn">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
            </div>
            
            
            <!-- Section Next Button -->
            <div class="next_btn">
              <!-- <div id="nextBtn" onclick="nextPrev(1)"> Next ➙ </div> -->
              <div type="button" id="nextBtn" onclick="nextPrev(1)"> Next ➙ </div>
            </div>

          </form>
        </div>
      </div>
    </section>
  
  </div>

  <script src="../assets/js/test.js"></script>
  <script src="../assets/js/block.js"></script>

</body>
</html>