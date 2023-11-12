<?php include("../filterSystem/personaldb_connect.inc.php");

	// 取得未學習單字總數
	$sqlvoc = "SELECT word FROM `voc`";
	$sqlyes = "SELECT word FROM `yes`";
	$sqlno = "SELECT word FROM `no`";
	$resultvoc = mysqli_query($conn, $sqlvoc);
	$resultyes = mysqli_query($conn, $sqlyes);
	$resultno = mysqli_query($conn, $sqlno);
	$total_words = mysqli_num_rows($resultvoc) + mysqli_num_rows($resultyes) + mysqli_num_rows($resultno);

	// 取得資料
	$sql = "SELECT word , COUNT(word) , SUM(result) FROM `quiz` GROUP BY word";
	$result = mysqli_query($conn, $sql);
	$total_records = mysqli_num_rows($result);
	$row1 = mysqli_fetch_row($result);
	$ans80 = array();   //儲存答對率80%以上的單字
	$ans50 = array();   //儲存答對率50%以下的單字
	$c1 = 0;
	$c2 = 0;
	$count = 0;
	while ($count < $total_records){
		// 答對率>80%的單字
		if($row1[2]/$row1[1] > 0.8){				
			array_push($ans80,$row1[0]);
			$c1++;
		}
		// 答對率<50%的單字
		if($row1[2]/$row1[1] < 0.5){			
			array_push($ans50,$row1[0]);			
			$c2++;
		}
		$count++;
		$row1 = mysqli_fetch_row($result);
	}

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>TESTING RECORD</title>
	<link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min2.css" rel="stylesheet"/>
    <link href="../assets/css/record/testrecord.css" rel="stylesheet" type="text/css"/>
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
                	<h1>TESTING RECORD</h1>
                	<h2>When even the smallest lessons feel like a victory, it’s easy to keep going.</h2>
            	</div>
        	</div>
		</section>


		<!----- Section Reocrd----->
    	<section class="section-record">
      		<div class="container">
			  	<div id="placeHolder">
					<canvas id="myChart"></canvas>
				</div>
      			<div class="row heading">
                	<div class="col-sm-6 col-12">
						<h3>Already Know</h3>
						<div id="modalBtn" class="btn-word"><h4>➙ Let's Revise</h4></div>
							<div id="myModal" class="modal">
								<div class="modal-content">
									<span class="close">&times;</span>
									<?php 
									for($i = 0;$i < $c1;$i++){
										echo "<p>".$ans80[$i]."</p>";}
									?>
								</div>
							</div>
					</div>
                	<div class="col-sm-6 col-12">
						<h3>Should Learn</h3>
						<div id="modalBtn1" class="btn-word"><h4>➙ Let's Learn</h4></div>
							<div id="myModal1" class="modal">
								<div class="modal-content">
									<span class="close1">&times;</span>
									<?php 
									for($i = 0;$i < $c2;$i++){
										echo "<p>".$ans50[$i]."</p>";}
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
	<script src="../assets/js/chart.js"></script>
	<script>
		var ans50 = <?php echo json_encode(count($ans50)) ?>;
		var ans80 = <?php echo json_encode(count($ans80)) ?>;
		var remain = <?php echo json_encode($total_words) ?>;

		var ctx = document.getElementById('myChart').getContext('2d');
		
		var data = {
		    datasets: [{
		        data: [ans80, ans50, remain],
		        backgroundColor: [
			    	'#8e9f93',
			        '#f3a395',
			        '#e0b39c'
		    	]
		    }],

		    // These labels appear in the legend and in the tooltips when hovering different arcs
			// 當懸停不同的圓弧時，這些標籤將顯示在圖例和工具提示中
		    labels: [
		        'Already Learned',
		        'Should Learn',
		        'Not Yet'
		    ]
		};

		var myChart = new Chart(ctx, {
		    type: 'doughnut',
		    data: data
		});
	</script>
	
	<script src="../assets/js/modal-testrecord.js"></script>
	
</body>
</html>



