$(document).ready(function() {
    
    /*----- 時間設置 -----*/
    
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
            modal.style.display = "block";
            var arr = ('<?php echo json_encode($alphabet) ?>');
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
                            element.style.color = "#d97272";   
                            element.textContent = arr[i][j];     				
                        }
                        index++;   			
                    }
                }      		
            }           
        }
        }, 500);
})