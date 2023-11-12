<?php include("../filterSystem/personaldb_connect.inc.php"); 
error_reporting(E_ALL^E_NOTICE); 


$sqlMax = "SELECT MAX(learnNum) FROM `learn`";
$rsMax = mysqli_query($conn, $sqlMax);
$row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
$max = $row[0];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>TEST OPTION</title>
    <link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width" initial-scale="1.0">
	
	<!-- css -->
	<link href="../assets/css/bootstrap.min2.css" rel="stylesheet"/>
    <link href="../assets/css/test/test-option.css" rel="stylesheet" type="text/css"/>
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
                	<h1 data-aos="fade-up" data-aos-delay="100">ALPHABETTER.</h1>
                	<h2 data-aos="fade-up" data-aos-delay="300">ALPHABETTER is the smartest way to level up your vocabulary.</h2>
                	<h4 data-aos="fade-up" data-aos-delay="500">Over 90% of students who use ALPHABETTER report higher grades.</h4>
            	</div>
        	</div>
    	</section>

        
    	<!----- Section Option ----->
        <section class="section-option">
            <div class="container">
                <div class="row heading">
                    <div class="option-select">
                        <h1>Test what you Learn</h1>
                	    <form method="POST" action="test.php">	
                            <div class="opt-select">
                                <select name="option">
                                    <option value="0" selected>Please select</option>
                                    <option value="<?php echo($max)?>">Last LEARN</option>
                                    <option value="1">1st LEARN</option>
                                    <option value="2">2nd LEARN</option>
                                    <option value="3">3rd LEARN</option>
                                    <option value="4">4th LEARN</option>
                                    <option value="5">5th LEARN</option>
                                    <option value="6">6th LEARN</option>
                                    <option value="7">7th LEARN</option>
                                </select>
                            </div>
                            <div class="btn-submit">
                                <input type="submit" class="btn btn-success" value="GET STARTED">
                            </div>
					    </form>
                    </div>
                </div>
            </div>
        </section>

        <!----- Section Btn
		<section class="section-btn">
        	<div class="container">
            	<div class="heading">   
                    <form method="POST" action="./test.php">  	
                        
                    </form>
                </div>
        	</div>
    	</section>----->


    	<!----- Footer ----->
		<footer>
			<p>Copyright ALPHABETTER By TEAM YANG</p>
		</footer>

		
    </div>
    <script src="../assets/js/Select.js"></script>

</body>
</html>
