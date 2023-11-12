<?php error_reporting(E_ALL^E_NOTICE); 
include("../filterSystem/personaldb_connect.inc.php");?>

<!----- PHP ----->
<?php

    $yes = "SELECT * FROM `yes`";
    $rs1 = mysqli_query($conn, $yes);
    $no = "SELECT * FROM `no`";
    $rs2 = mysqli_query($conn, $no);
    $num = mysqli_num_rows($rs1) + mysqli_num_rows($rs2);  
    echo mysqli_num_rows($rs1)."!!!".mysqli_num_rows($rs2);
    if(mysqli_num_rows($rs1)<2 || mysqli_num_rows($rs2)<8){
        echo '<meta http-equiv=REFRESH ;url=../loginSystem/filter-chosen.php>';
    }
	
	// 宣告二維陣列
    $words[9][2] = "";
	$num = 0;
	
    // 取得時間
    $time = date("Y-m-d H:i:s");

    // 取得資料
    $sqlCount = "SELECT COUNT(word) FROM `learn`";
    $rsCount =  mysqli_query($conn, $sqlCount);
    while($row = mysqli_fetch_array($rsCount, MYSQLI_NUM)){
        $count = ceil($row[0]/10) + 1;
    }

    $sqlYes = "SELECT * FROM `yes` ORDER BY RAND( ) LIMIT 2";
    $rsYes = mysqli_query($conn, $sqlYes);
    if(mysqli_num_rows($rsYes) > 0){

        // 每行輸出顯示
        while($row = mysqli_fetch_array($rsYes, MYSQLI_NUM)){
            $words[$num][0] = $row[0];
            $words[$num][1] = $row[1];
            $words[$num][2] = $row[2];
            $id = $num + 1;
            $learn = "INSERT INTO `learn` (`learnNum`, `id`, `word`, `ch`, `en`, `startTime`) VALUES ('$count', '$id', '$row[0]', '$row[1]', '$row[2]', '$time')";
            $rs = mysqli_query($conn, $learn);
            $num++;

            // 執行SQL刪除單字記錄
            $sqlDel = "DELETE FROM `yes` WHERE word='$row[0]'";
            if($conn->query($sqlDel) === TRUE){
            }else{
                echo "Error deleting record: " . $conn->error;
            }
        }

    }else{
        echo "0 results";
    }

    $sqlNo = "SELECT * FROM `no` ORDER BY RAND( ) LIMIT 8";
    $rsNo = mysqli_query($conn, $sqlNo);
    if(mysqli_num_rows($rsNo) > 0){

        // 每行輸出顯示
        while($row = mysqli_fetch_array($rsNo, MYSQLI_NUM)){
            $words[$num][0] = $row[0];
            $words[$num][1] = $row[1];
            $words[$num][2] = $row[2];
            $id = $num + 1;
            $learn = "INSERT INTO `learn` (`learnNum`, `id`, `word`, `ch`, `en`, `startTime`) VALUES ('$count', '$id', '$row[0]', '$row[1]', '$row[2]', '$time')";
            $rs = mysqli_query($conn, $learn);
            $num++;

            // 執行SQL刪除單字記錄
            $sqlDel = "DELETE FROM `no` WHERE word='$row[0]'";
            if($conn->query($sqlDel) === TRUE){
            }else{
                echo "Error deleting record: " . $conn->error;
            }
        }

    }else{
        echo "0 results";
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>LEARN</title>
	<link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>	
	<link href="../assets/css/learn/learn+gamelearn.css" rel="stylesheet" type="text/css"/>
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
                                <a href="home.html" class="btn btn-success">↩ BACK</a>
                            </div>
							<div class="sticky-logo">
								<a href="home.html"><img src="../assets/images/logo/logo60.png" alt=""></a>
							</div>
							<div class="logo-small-device">
								<a href="home.html"><img src="../assets/images/logo/logo80.png"></a>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 d-none d-md-block">
							<div class="logo-menu-wrapper text-center">
								<div class="logo">
									<a href="home.html"><img src="../assets/images/logo/logo80.png" alt=""/></a>
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

		<!----- Section  Card ----->
		<section class="section-card">
			<div class="jumbotron jumbotron-fluid d-flex align-items-center">
            	<div class="container-fluid content">
					<h6 id="timer"></h6>
						<div class="ul_word">       
							<li class="li_word">           
								<div class="card">                
									<div class="card-inner">
										<h4>WORD 1</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="0"></button>
											<h2> <?php echo $words[0][0];?> </h2>
											<p> <?php echo $words[0][1];?> </p>
										</div> 
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 2</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="1"></button>
											<h2> <?php echo $words[1][0];?> </h2>
											<p> <?php echo $words[1][1];?> </p>
										</div> 
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 3</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="2"></button>
											<h2> <?php echo $words[2][0];?> </h2>
											<p> <?php echo $words[2][1];?> </p>
										</div>
									</div> 
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 4</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="3"></button>
											<h2> <?php echo $words[3][0];?> </h2>
											<p> <?php echo $words[3][1];?> </p>
										</div>
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 5</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="4"></button>
											<h2> <?php echo $words[4][0];?> </h2>
											<p> <?php echo $words[4][1];?> </p>
										</div>
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 6</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="5"></button>
											<h2> <?php echo $words[5][0];?> </h2>
											<p> <?php echo $words[5][1];?> </p>
										</div>
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 7</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="6"></button>
											<h2> <?php echo $words[6][0];?> </h2>
											<p> <?php echo $words[6][1];?> </p>
										</div>
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 8</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="7"></button>
											<h2> <?php echo $words[7][0];?> </h2>
											<p> <?php echo $words[7][1];?> </p>
										</div>
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 9</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="8"></button>
											<h2> <?php echo $words[8][0];?> </h2>
											<p> <?php echo $words[8][1];?> </p>
										</div>
									</div>
								</div>
							</li>
							<li class="li_word">
								<div class="card">
									<div class="card-inner">
										<h4>WORD 10</h4>
										<div class="buttonbar">
											<button class="ion-ios-play" value="9"></button>
											<h2> <?php echo $words[9][0];?> </h2>
											<p> <?php echo $words[9][1];?> </p>
										</div>
									</div>
								</div>
							</li>
						</div>

						<!-- Section Card Slide Button -->
						<div class="slide_btn">1</div>
						<div class="slide_btn">2</div>
						<div class="slide_btn">3</div>
						<div class="slide_btn">4</div>
						<div class="slide_btn">5</div>
						<div class="slide_btn">6</div>
						<div class="slide_btn">7</div>
						<div class="slide_btn">8</div>
						<div class="slide_btn">9</div>
						<div class="slide_btn">10</div>
						
				</div>
			</div>
		</section>

	</div>

	<!--<script src="../assets/js/bridge.js"></script>-->
	<script src="../assets/js/slider.js"></script>
	<script src="../assets/js/block.js"></script>
</body>
</html>