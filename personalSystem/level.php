<?php include("../filterSystem/personaldb_connect.inc.php");

	// 分數對應等級
	function matchLevel($point){
		return floor(sqrt(0.02 * $point + 0.25) - 0.5);
    }
    
	// 等級對應分數
	function matchPoint($level){
		return 50 * ($level * $level + $level);
    }
    
	// 還差多少升等
	function leavePoint($point){
		return matchPoint(matchLevel($point) + 1) - $point;
	}

	$points = array();;
	$num = 0;

	// 讀取積分資料
	$sqlPoint = "SELECT * FROM `level` ORDER BY `time`";
    $rsPoint = mysqli_query($conn, $sqlPoint);
    if(mysqli_num_rows($rsPoint) > 0){

        // 每行輸出顯示
        while($row = mysqli_fetch_array($rsPoint, MYSQLI_NUM)){
            $points[$num][0] = $row[0];
            $points[$num][1] = $row[1];
            $points[$num][2] = $row[2];
			$num++;
        }

    }else{
        echo "0 results";
    }

    // 計算分數
    $point = 0;
    for ($i = 0; $i < count($points); $i++) { 
    	$point += $points[$i][0];
    }

    $point = $point * 10;
    $level = matchLevel($point);
    $leavePoint = leavePoint($point);
	$nextLevelPoint = matchPoint($level + 1);
	
	switch ($level) {
		case 1:   //等級1
			$img = "../assets/images/1.png";
            $sentenceCh = "『 初生之犢猛于虎。』";
            $sentenceEn = "「Newborn calves are not afraid of tigers.」";
            break;
		case 2:   //等級2
			$img = "../assets/images/1.png";
            $sentenceCh = "『 獨善潛修，韜光養晦。』";
            $sentenceEn = "「 Hide your light under a bushel,then become better.」";
            break;
		case 3:   //等級3
			$img = "../assets/images/1.png";
            $sentenceCh = "『 雖青年，已自成人，能取進士第，嶄然露頭角。』";
            $sentenceEn = "「 At a very young age,you've been showcasing  the talent to the world.」";
            break;
		case 4:   //等級4
			$img = "../assets/images/1.png";
            $sentenceCh = "『 使遂蚤得處囊中，乃穎脫而出，非特其末見而已。』";
            $sentenceEn = "「 Stand out from the crowd.」";
            break;
		case 5:   //等級5
			$img = "../assets/images/1.png";
            $sentenceCh = "『 總共有一石，而汝獨得八斗，此系統得一斗，天下人共一斗。』";
            $sentenceEn = "「 You are endowed with extraordinary talents.」";
            break;
        default:
            $sentenceCh = "『 一分耕耘，一分收穫。』";
            $sentenceEn = "「 No pain no gain.」";
            break;
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>LEVEL</title>
	<link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>	
	<link href="../assets/css/personal/level.css" rel="stylesheet" type="text/css"/>
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
		
		
		<!----- Banner ----->
		<section class="banner">
        	<div class="jumbotron d-flex align-items-center">
            	<div class="container-fluid content">
                	<h1>Level</h1>
                	<h2>Your next win is just a fact away.</h2>
            	</div>
        	</div>
		</section>


        <!----- Section Level ----->
        <section class="section-level">
            <div class="container-fluid">
                <div class="row heading">
                    <div class="col-md-4 ml-auto">
                        <div class="cube">
                        <h2>Your Best Performance In <mark>ALPHABETTER</mark></h2>
                        <span class="text">Progress</span>
                        <div class="p" id="bar"></div>
                        <h3><?php echo $leavePoint;?> points are required to proceed to the next level.</h3>
                        <span class="number"><span><small>LV</small> <?php echo $level;?> </span></span>
						<hr class="line">
                        <p><img src="<?php echo $img;?>"/></p> 
                        <h5>  <?php echo $sentenceCh;?>  </h5>
                        <h6>  <?php echo $sentenceEn;?>  </h6>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h4>Display History</h4>
                        <table id="table1" width="100%" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Point</th>
                                <th>Type</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                            <?php 
                                for ($id = 0; $id < count($points); $id++){ 
                                    $add = $points[$id][0] * 10;
                                    echo "<tbody>";
                                    echo "<tr>";
                                    echo "<td>".$add."</td>";
                                    echo "<td>".$points[$id][1]."</td>";
                                    echo "<td>".$points[$id][2]."</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
	                        ?>
                        </table>
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
	var target = <?php echo json_encode($point/$nextLevelPoint * 100) ?>;
	var config ={
		mountedId: '#bar',
		target: target,
		step: 0.5,
		color: '#2A2A2A',
		fontSize: "20px",
		borderRadius: "5px",
		backgroundColor: 'ghostwhite',
		barBackgroundColor: '#5A7262',
		};

	var p = new Progress();
    p.init(config);

	</script>
</body>
</html>