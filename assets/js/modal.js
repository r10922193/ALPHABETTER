
/*----- 可彈出視窗設置 -----*/

// 設置可彈出視窗
var modal = document.getElementById("myModal");

// 設置按鈕
var btn = document.getElementById("modalBtn");

// 關閉可彈出視窗按鈕
var span = document.getElementsByClassName("close")[0];

// 選取按鈕打開可彈出視窗
btn.onclick = function(){
  modal.style.display = "block";
}

// 選取關閉按鈕關閉可彈出視窗
span.onclick = function(){
  modal.style.display = "none";
}

// 選取可彈出視窗以外區域也可以關閉
window.onclick = function(event){
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


/*----- 分數滾動設置 

$('.score').each(function(){
  $($score).prop('Counter', 0).animate({
      Counter: $($score).text()
  }, {
      duration: 5000,
      easing: 'swing',
      step: function(now) {
          $($score).text(Math.ceil(now));
      }
  });
});

$(function(){
  $(".score").numberRock({
   duration : 5000,
   easing : 'swing',  //慢快慢
  });
 });
 
 -----*/