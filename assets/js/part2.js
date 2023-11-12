$(document).ready(function() {

// 單擊刪除列表項中單字
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// 顯示英文單字
var coll = document.getElementsByClassName("collapsible");
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


// 滑鼠點擊時候變色  
var IsFinished = false; 
  
function do_change(){  
  if (IsFinished) return false;
  
  var obj = window.event.srcElement;   
  if(obj.style.backgroundColor == ""){          
  obj.style.backgroundColor = "#E0B39C"; 
  obj.style.color = "#2A2A2A";  
      obj.tag = true;     
  }else{
      obj.style.backgroundColor = "";     
      obj.tag = false;  
  }
} 


// 取得解答小窗口
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");  

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

btn.onclick = function(){   // 倒計時結束彈出視窗
    modal.style.display = "block";
}

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}




