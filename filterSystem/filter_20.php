<?php include("./personaldb_connect.inc.php");
error_reporting(E_ALL^E_NOTICE); 


// 取得資料
$sql = "SELECT * FROM `voc` ORDER BY RAND( ) LIMIT 1";
$result = mysqli_query($conn, $sql);

// 取出資料
$row = mysqli_fetch_array($result, MYSQLI_NUM);
$word = $row[0];
$ch = $row[1];  
$en = $row[2];
$_SESSION['ids'] = $word;

// 判斷目前題數
$yes = "SELECT * FROM `yes`";
$rs1 = mysqli_query($conn, $yes);
$no = "SELECT * FROM `no`";
$rs2 = mysqli_query($conn, $no);
$num = mysqli_num_rows($rs1) + mysqli_num_rows($rs2);
$progress = $num - $_SESSION['init'] + 1;

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>FILTER20</title>
	<link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>	
	<link href="../assets/css/filter/filter20.css" rel="stylesheet" type="text/css"/>
	<link href="../assets/css/ionicons.min.css" rel="stylesheet"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif+TC&display=swap" rel="stylesheet"/>

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
                                <a href="../loginSystem/filter-chosen.php" class="btn btn-success">↩ BACK</a>
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
									<a href="../learnSystem/home.html"><img src="../assets/images/logo/logo80.png"></a>
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

		<!----- Section Flip Card ----->
		<!----- PHP ----->
		<section class="section-flip-card">
        	<div class="jumbotron jumbotron-fluid d-flex align-items-center">
            	<div class="container-fluid content">
                	<h3><?php echo $progress;?>/20</h3>
                	<div class="flip-card">
                		<div class="flip-card-inner">
                			<div class="flip-card-front">
                				<h1><?php echo "<br>".$word;?></h1>
                			</div>
                			<div class="flip-card-back">
                				<h2><?php echo "<br>".$ch;?></h2>
                			</div>
                		</div>
                	</div>
					<form action="./addYes_20.php" method="post" style="display:inline">
                    	<input type="hidden" name="word" value="<?php echo($word);?>" />
                    	<input type="submit" class="btn btn-success" value="Already Know">
                  	</form>
                  	<form action="./addNo_20.php" method="post" style="display:inline">
                    	<input type="hidden" name="word" value="<?php echo($word);?>" />
                    	<input type="submit" class="btn btn-success" value="Should Learn">
                  	</form>
                	<!--
					<input type="submit" class="btn btn-success" onClick="javascript:location.href='./addYes_20.php'" value="Already Know">
            		<input type="submit" class="btn btn-success" onClick="javascript:location.href='./addNo_20.php'" value="Should Learn">
					-->
            	</div>
        	</div>
		</section>

	</div>

    <!----- PHP ----->
	<?php
    
    // 釋放記憶體
    mysqli_free_result($result);
      
    // 關閉連線
    mysqli_close($conn);
    ?>

	</body>
</html>
