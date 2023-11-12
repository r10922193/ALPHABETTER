
$(document).ready(function(){

    //跑動的次數
    var count = 0;
    //動畫轉場方向
    var isgo = false;
    //定義計時器
    var timer;

    window.onload = function(){

        //取得 ul
        var ul_word = document.getElementsByClassName("ul_word")[0];
        //取得所有 li 題卡
        var li_word = document.getElementsByClassName("li_word");
        //取得按鈕
        var slide_btn = document.getElementsByClassName("slide_btn");
        slide_btn[0].style.backgroundcolor = "transparent";

        //定義計時器
        //控制題卡移動
        showtime();
        function showtime(){
            timer = setInterval(function(){
                if(isgo == false){
                    count++;
                    ul_word.style.transform = "translate(" + -650 * count + "px)";
                    if(count >= 10 - 1){
                        count = 10 - 1;
                        isgo = true;
                    }
                }
                else{
                    count--;
                    ul_word.style.transform = "translate(" + -650 * count + "px)";
                    if(count <= 0){
                        count = 0;
                        isgo = false;
                    }
                }

                for(var i = 0; i < 10; i++){
                    slide_btn[i].style.backgroundColor = "transparent";
                }

                slide_btn[count].style.backgroundColor = "#5A7262";

            }, 30000)
        }

        //鼠标悬停底部數字按钮
        for(var b = 0; b < 10; b++){
            slide_btn[b].index = b;
            slide_btn[b].onmouseover = function(){

                clearInterval(timer);

                for(var a = 0; a < 10; a++){
                    slide_btn[a].style.backgroundColor = "transparent";
                }

                slide_btn[this.index].style.backgroundColor = "#5A7262";

                //對應 count 值以控制方向
                if(this.index == 3){
                    isgo = true;
                }
                if(this.index == 0){
                    isgo = false;
                }

                count = this.index;
                ul_word.style.transform = "translate(" + -650 * this.index + "px)";
            }

            slide_btn[b].onmouseout = function(){
                
            //計時器
            showtime();
            }
        }
    }
})