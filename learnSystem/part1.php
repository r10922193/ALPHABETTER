<?php include("./part1qa.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PART 1</title>
    <link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
  
    <!-- css -->
    <link href="../assets/css/bootstrap.min2.css" rel="stylesheet"/>
    <link href="../assets/css/learn/part1.css" rel="stylesheet" type="text/css"/>
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
                                <a href="part1_tips.html" class="btn btn-success">↩ BACK</a>
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


        <!----- Section Word Search ----->
        <section class="section-word-search">
            <div class="timer">
                <h4 id="timer"></h4>
            </div>
                <div class="container-fluid">
                    <div class="col-sm-2 col-12">
                        <ul>
                            <h1>Word Search</h1>   
                            <?php 
                            for ($id=0; $id < count($words); $id++){ 
                                echo "<li>".$words[$id]."</li>";}
                            ?>
                        </ul>
                    </div>

                    <div class="col-sm-10 col-12">
                    <?php
                        echo "<table id=\"table1\" width=\"80%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
                        for($a=0;$a<18;$a++)
                        {
                        echo "<tr>" ;
                        for($b=0;$b<18;$b++){
                            if ($alphabet[$a][$b] != ""){
                            echo "<td class=\"correct\" onClick=\"do_change()\">";
                            echo $alphabet[$a][$b];
                            echo "</td>";
                            }else{
                            echo "<td class=\"wrong\" onClick=\"do_change()\">";
                            echo chr(rand(97, 122));
                            echo "</td>";
                            }
                        }
                        echo "</tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>     
                </div>    
        </section>

        <section class="section-next">
            <!--a href="./part2_tips.html"-->
            <div class="btn btn-success" id="next">GO PART 2</a>
        </section>

        <!----- Footer ----->
		<footer>
			<p>Copyright ALPHABETTER By TEAM YANG</p>
		</footer>


    </div>

    <!--<script src="../assets/js/part1.js?v=1.321"></script>-->
    <script src="../assets/js/part1.js"></script>
    <script src="../assets/js/timer-part1.js"></script>
    <script src="../assets/js/block.js"></script>

</body>
</html>