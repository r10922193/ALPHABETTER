$(document).ready(function() {


})

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

  // 倒計時結束
  if (distance < 0){
    clearInterval(x);
    document.getElementById("timer").innerHTML = "Time Out";
    window.location.href = './part1_tips.html';
  }
}, 500);
