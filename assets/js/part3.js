$(document).ready(function() {

// 單擊刪除列表項中單字
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
    if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
    }
}, false);
    
// 顯示英文單字
var coll = document.getElementsByClassName("modal-answer");
var i;

for (i = 0; i < coll.length; i++){
  coll[i].addEventListener("click", function(){
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block"){
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
})


/*
// 取得解答小窗口
var modal = document.getElementById("myModal");
  btn.onclick = function(){   // 倒計時結束彈出視窗
    modal.style.display = "block";
}
*/
