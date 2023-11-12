$(document).ready(function() {

// 單擊刪除列表項中單字
var list = document.querySelector('ul');
list.addEventListener('click', function(ev){
	if (ev.target.tagName === 'LI'){
		ev.target.classList.toggle('checked');
	}
}, false);

});


// 點擊窗格時變色  
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


