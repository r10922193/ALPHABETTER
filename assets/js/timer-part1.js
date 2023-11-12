$(document).ready(function() {
    
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
		var myMusic = new sound("./music/clock.mp3");
		myMusic.play();
	  }

	// 倒計時結束
	if (distance < 0){
		IsFinished = true;
		clearInterval(x);
    	document.getElementById("timer").innerHTML = "Time Out";
    	var correct = document.getElementsByClassName("correct");
    	var wrong = document.getElementsByClassName("wrong");
        	for (let index = 0; index < correct.length; index++){
    			var element = correct[index];
    			if (element.style.backgroundColor == ""){
					element.style.backgroundColor = "#e4886a"; 
					element.style.color = "#FFFFFF"; 
    				element.tag = true;
      			}
  			}

			for (let index = 0; index < wrong.length; index++){
				var element = wrong[index];
				if (element.style.backgroundColor != ""){
					element.style.backgroundColor = "";     
					element.tag = false;  
					element.style.backgroundColor = "#5A7262";  
					element.style.color = "#FFFFFF";   
					element.tag = true;
				}
			}
		}

	}, 500);


	document.getElementById("next").onclick = function(){
		if (IsFinished == false) return;
		location.href='../learnSystem/part2_tips.html';
	}
})