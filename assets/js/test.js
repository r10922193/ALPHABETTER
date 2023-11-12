
  /*----- 題數按鈕設置 -----*/

  // 將當前題卡設置為第一題 Current tab is set to be the first tab (0)
  var currentTab = 0; 
  // 顯示當前題卡 Display the current tab
  showTab(currentTab); 
  
  function showTab(n){
    // 此函數將顯示表單的指定題卡 This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // 執行 Next 按鈕 ... and fix the Next buttons:
    if (n == (x.length - 1)){
      document.getElementById("nextBtn").innerHTML = "Submit";
    }else{
      document.getElementById("nextBtn").innerHTML = "Next ➙";
    }

  // 執行一個正確顯示的題數軸 ... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }
  

  /*----- Next 按鈕設置 -----*/

  function nextPrev(n){

    // 找出要顯示的題卡 This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // 如果當前題卡中的任何字段無效，則退出 Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // 隱藏當前題卡 Hide the current tab:
    x[currentTab].style.display = "none";
    // 將當前題卡數增加或減少一 Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // 如果已到節達表單末 if you have reached the end of the form ...
    if (currentTab >= x.length){
      // 提交表單 ... the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    // 如無，顯示正確的題卡 Otherwise, display the correct tab:
    showTab(currentTab);
  }
  

  /*----- 驗證欄位正確性 -----*/

  function validateForm(){
    // 處理表單欄位正確性 This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    if (valid){
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;  //回復有效狀態 return the valid status
  }
  

  /*----- 設置當前題卡為 "active" class -----*/

  function fixStepIndicator(n){
    // 移除所有題卡數的 "active" class This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++){
      x[i].className = x[i].className.replace(" active", "");
    }
    // 新增 "active" class 於當前題卡 ... and adds the "active" class on the current step:
    x[n].className += " active";
  }
  
