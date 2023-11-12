<?php include("../filterSystem/personaldb_connect.inc.php");

	// 取得單字總數
	$sqlvoc = "SELECT word FROM `voc`";
	$sqlyes = "SELECT word FROM `yes`";
	$sqlno = "SELECT word FROM `no`";
	$sqllearn = "SELECT word FROM `learn`";
	$resultvoc = mysqli_query($conn, $sqlvoc);
	$resultyes = mysqli_query($conn, $sqlyes);
	$resultno = mysqli_query($conn, $sqlno);
	$resultlearn = mysqli_query($conn, $sqllearn);
	$total_words = mysqli_num_rows($resultvoc) + mysqli_num_rows($resultyes) + mysqli_num_rows($resultno) + mysqli_num_rows($resultlearn);

	// 取得所有單字
	$sql1 = "SELECT word, ch FROM `learn`";
	$result = mysqli_query($conn, $sql1);
	$total_records = mysqli_num_rows($result);
	$words = array();
	$chs = array();
	$id = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
	    $words[$id] = $row[0];
	    $chs[$id] = $row[1];
	    $id++;}

	// 取得最近一次學習單字數 $max
	$sqlMax = "SELECT MAX(learnNum) FROM `learn`";
	$rsMax = mysqli_query($conn, $sqlMax);
	$row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
	$max = $row[0];

	// 總學習時間（每次流程20分鐘）
	$learnTime = round((20 * $max / 60),2);

	// 學習過的單字數/總單字量
	$learnRate = round(($total_records / $total_words)*100,2);

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>LEARNING RECORD</title>
	<link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min2.css" rel="stylesheet"/>
    <link href="../assets/css/record/learnrecord.css" rel="stylesheet" type="text/css"/>
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


		<!----- Banner ----->
		<section class="banner">
        	<div class="jumbotron d-flex align-items-center">
            	<div class="container-fluid content">
                	<h1>LEARNING RECORD</h1>
                	<h2>Each new thing you learn is an achievement.</h2>
            	</div>
        	</div>
		</section>


		<!----- Section Progress----->
    	<section class="section-progress">
    		<div class="container">
            	<div class="heading">
					<h3>Learning Progress</h3>  
					<h2><?php echo $learnRate;?>%</h2>	
					<div class="p" id="bar"></div>
                </div>
        	</div>
		</section>
		

		<!----- Section Reocrd----->
    	<section class="section-record">
      		<div class="container">
      			<div class="row heading">
                	<div class="col-sm-6 col-12">
                    	<h3>Total Learning Time</h3>
                    	<h5><?php echo $learnTime;?> <span>hours</span></h5>
                	</div>
                	<div class="col-sm-6 col-12">
                		<h2>Learned Words</h2>
                		<div id="modalBtn" class="btn-word"><h4>Let's Check</h4></div>
							<div id="myModal" class="modal">
								<div class="modal-content">
								<span class="close">&times;</span>
								<?php 
									for ($id=0; $id < count($words); $id++){ 
										//echo "<p>".$words[$id].$chs[$id]."</p>";}
										echo "<p class=\"word\">".$words[$id]."</p>";
										echo "<p class=\"ch\">".$chs[$id]."</p>";}
								?>
								</div>
							</div> 
                	</div>
                </div>
          	</div>
		</section>


		<!----- Footer ----->
		<footer>
			<p>Copyright ALPHABETTER By TEAM YANG</p>
		</footer>
		
	</div>
	<script src="../assets/js/progress.js"></script>
	<script>

	// progress
	var target = <?php echo json_encode($learnRate) ?>;
	var config ={
		mountedId: '#bar',
		target: target,
		step: 0.5,
		color: '#2A2A2A',
		fontSize: "20px",
		borderRadius: "5px",
		backgroundColor: '#ffffff',
		barBackgroundColor: '#5A7262',
		};

	var p = new Progress();
	p.init(config);

	</script>

	<script src="../assets/js/modal.js"></script> 
	<script src="../assets/js/block.js"></script> 

</body>
</html>