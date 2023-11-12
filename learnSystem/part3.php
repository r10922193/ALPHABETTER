<?php include("./part3qa.php");?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>PART 3</title>
    <link href="../assets/images/logo/favicon.ico" rel="icon" type="image/x-icon"/>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
  
    <!-- css -->
    <link href="../assets/css/bootstrap.min2.css" rel="stylesheet"/>
    <link href="../assets/css/learn/part3.css" rel="stylesheet" type="text/css"/>
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
                                <a href="part3_tips.html" class="btn btn-success">↩ BACK</a>
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
                    <div class="col-sm-3 col-12">
                        <ul>
                            <h1>Crossword Puzzle</h1>   
                            <h2>Vertical</h2>
							<?php
							for ($v=0; $v < $ver; $v++) {
								echo "<li>".$vertIndex[$v][0].". ".$chs[$vertIndex[$v][1]]."<br></li>";
							}
							echo "<br>";
							?>
							<h2>Horizontal</h2>
							<?php
							for ($h=0; $h < $hor; $h++) {
								echo "<li>".$horiIndex[$h][0].". ".$chs[$horiIndex[$h][1]]."<br></li>";
							}
							?>
                        </ul>
                    </div>

                    <div class="col-sm-9 col-12">
                    <?php
					for ($a=0; $a < 100; $a++){ 
						for($b=0; $b < 100; $b++){
							if ($alphabet[$a][$b] != ""){
								$up = $a;
								break 2;
							}
						}
					}
					for ($a=100; $a >= 0; $a--){ 
						for($b=0; $b < 100; $b++){
							if ($alphabet[$a][$b] != ""){
								$down = $a;
								break 2;
							}
						}
					}
					for ($b=0; $b < 100; $b++){ 
						for($a=0; $a < 100; $a++){
							if ($alphabet[$a][$b] != ""){
								$left = $b;
								break 2;
							}
						}
					}
					for ($b=100; $b >= 0; $b--){ 
						for($a=0; $a < 100; $a++){
							if ($alphabet[$a][$b] != ""){
								$right = $b;
								break 2;
							}
						}
					}
					// 印出表格
					$count = 0;
					$p = "";
					echo "<table id=\"table1\" width=\"80%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
					for($a=$up;$a<=$down;$a++) {
						echo "<tr>"	;
						for($b=$left;$b<=$right;$b++){
							if ($alphabet[$a][$b] != ""){
								$bool = false;
								for ($v=0; $v < $vertical; $v++){
									if ($vert[$v][1] == $a && $vert[$v][2] == $b){
										$count++;
										$p = $count;
										$bool = true;
										break 1;
									}
								}
								for ($h=0; $h < $horizonal; $h++){ 
									if ($hori[$h][1] == $a && $hori[$h][2] == $b){
										if ($bool) {
											$p = $count;
											break 1;
										}
										$count++;
										$p = $count;
										break 1;
									}
								}
								echo "<td class=\"td_answer\">";
								echo "<h5 class=\"n\">".$p."</h5>";
								$p = "";
								echo '<div class="od" contenteditable="true" onkeypress="return (this.innerText.length <= 0)">';
								//echo $alphabet[$a][$b];
								echo "</div>";
								echo "</td>";
							}else{
								echo "<td>";
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
		
		<!----- Section Answer 
        <section class="section-answer">
            <div id="myModal" class="modal"> 
                <div class="modal-answer">ANSWER</div>
                    <div class="content">
					
					//echo "<p>Vertical</p>";
					//for ($v=0; $v < $ver; $v++) {
						//echo "<p>".$vertIndex[$v][0].". ".$words[$vertIndex[$v][1]]."</p>";
					//}
					//echo "<p>Horizonal</p>";
					//for ($h=0; $h < $hor; $h++) {
						//echo "<p>".$horiIndex[$h][0].". ".$words[$horiIndex[$h][1]]."</p>";
					//}
					
                    </div>
                
            </div>
        </section>----->

        
        <!----- Section Word Search ----->
        <section class="section-next">
            <!--a href="./home.html"-->
            <div class="btn btn-success" id="next">DONE !</a>
        </section>


        <!----- Footer ----->
        <footer>
          <p>Copyright ALPHABETTER By TEAM YANG</p>
        </footer>
		
    </div>
    
    <style> 
    [contenteditable] {
        outline: 0px solid transparent;
    }
    </style>

	<script>
    
    /*----- 時間設置 -----*/

    var IsFinished = false;
    
    // 設置倒數的時間
    var countDown = new Date().getTime()+5*60*1000;
    
    // 每一秒更新一次計數
    var x = setInterval(function(){
    
        // 取得今天的日期和時間
        var now = new Date().getTime();
        
        // 計算此刻與倒計時日期時間的距離
        var distance = countDown - now;
       
        // 時間計算：天、小時、分鐘、秒
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // 結果輸出
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
        if (distance == 0){
          var myMusic = new sound("../assets/music/clock.mp3");
          myMusic.play();
        }

        // 倒計時結束
        if (distance < 0){
            IsFinished = true;
            clearInterval(x);
            document.getElementById("timer").innerHTML = "Time Out";
            //modal.style.display = "block";
            var arr = <?php echo json_encode($alphabet) ?>;
            var od = document.getElementsByClassName("od");
            var index = 0;
            for (var i= 0; i < 36; i++){
                for (var j = 0; j < 36; j++){
                    if (arr[i][j] != null){
                        var element = od[index];
                        if (element.textContent == ""){
                            element.style.color = "#d97272";   
                            element.textContent = arr[i][j];  
                        } else if(element.textContent != arr[i][j]){
                            element.style.color = "#5A7262";   
                            element.textContent = arr[i][j];     				
                        }
                        index++;   			
                    }
                }      		
            }           
        }
        }, 1000);

        document.getElementById("next").onclick = function(){
        if (IsFinished == false) return;
        location.href='./home.html';
        }

	</script>


    <script src="../assets/js/part3.js"></script>
    <!--<script src="../assets/js/block.js"></script>
  	<script src="../assets/js/timer-part3.js"></script>-->

</body>
</html>