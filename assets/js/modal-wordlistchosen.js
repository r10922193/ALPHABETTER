    
    // 設置可彈出視窗
    var modal1 = document.getElementById("id01");

    // 設置按鈕
    var btn1 = document.getElementById("modalBtn1");

    // 設置可彈出視窗
    var modal2 = document.getElementById("id02");

    // 設置按鈕
    var btn2 = document.getElementById("modalBtn2");

    // 設置可彈出視窗
    var modal3 = document.getElementById("id03");

    // 設置按鈕
    var btn3 = document.getElementById("modalBtn3");

    // 選取按鈕打開可彈出視窗
    btn1.onclick = function(){
        modal1.style.display = "block";
    }

    // 選取按鈕打開可彈出視窗
    btn2.onclick = function(){
        modal2.style.display = "block";
    }

    // 選取按鈕打開可彈出視窗
    btn3.onclick = function(){
        modal3.style.display = "block";
    }

    // 選取可彈出視窗以外區域也可以關閉
    window.onclick = function(event){
        if (event.target == modal1) {
        modal1.style.display = "none";
        }
        if (event.target == modal2) {
        modal2.style.display = "none";
        }
        if (event.target == modal3) {
        modal3.style.display = "none";
        }
    }