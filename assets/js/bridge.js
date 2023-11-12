function play(elementClassIndex){
    var DOMtag = document.getElementsByTagName("h2")[elementClassIndex].innerHTML;
    var test = JSON.stringify({vocab:DOMtag, index:elementClassIndex});
    $.ajax({
        type:"GET",
        //url:"http://alphabetter-v1.herokuapp.com/ALPHABETTER/learnSystem/text2speech.php",
        url:"http://localhost/ALPHABETTER/learnSystem/text2speech.php",
        //url:"https://finalpresentation2.mybluemix.net/text2speech.php",
        data: {data:test},
        contentType: "application/json"
    }).done(function(res){
        var result = JSON.parse(res);
        //var audioURL = "http://alphabetter.herokuapp.com/ALPHABETTER/learnSystem/" + result["audiofile"];
        var audioURL = "http://localhost//ALPHABETTER/learnSystem/" + result["audiofile"];
        //var audioURL = "https://finalpresentation2.mybluemix.net/" + result["audiofile"];
        var elementIndex = result["classIndex"];
        var soundID = "audio" + elementIndex;
        var buttonBar = document.getElementsByClassName("buttonbar")[elementIndex];
        var sound = document.createElement("audio");
        sound.class = "audio";
        sound.id = soundID;
        sound.src = audioURL;
        buttonBar.appendChild(sound);
        var textToSpeech = document.getElementById(soundID);
        textToSpeech.play();
    }).fail(function(res){

    });
}


// Runs after page is loaded
$(document).ready(function(){
    $(".ion-ios-play").click(function(){
        play($(this).val());
});
});


/*

// Runs when page is being loaded
$(function(){
    $.ajax({
        type:"GET",
        //url:"http://alphabetter-v1.herokuapp.com/ALPHABETTER/learnSystem/requests.php",
        url:"http://localhost/ALPHABETTER/learnSystem/requests.php"
        //url:"https://finalpresentation2.mybluemix.net/requests.php"
    }).done(function(res){
        var dictionary = JSON.parse(res);
        var wordlist = document.getElementsByClassName("card-inner");
        var count = 0;
        for(var key in dictionary){
            if(wordlist[count].contains(document.getElementsByTagName("h2")[0]) && wordlist[count].contains(document.getElementsByTagName("p")[0])){
                oldh2 = document.getElementsByTagName("h2")[0];
                oldp = document.getElementsByTagName("p")[0];
                wordlist[count].removeChild(oldh2);
                wordlist[count].removeChild(oldp);
                newh2 = document.createElement("h2");
                nodeh2 = document.createTextNode(key);
                newh2.appendChild(nodeh2);
                newp = document.createElement("p");
                nodep = document.createTextNode(dictionary[key]);
                newp.appendChild(nodep);
                wordlist[count].appendChild(newh2);
                wordlist[count].appendChild(newp);
            } else {
                newh2 = document.createElement("h2");
                nodeh2 = document.createTextNode(key);
                newh2.appendChild(nodeh2);
                newp = document.createElement("p");
                nodep = document.createTextNode(dictionary[key]);
                newp.appendChild(nodep);
                wordlist[count].appendChild(newh2);
                wordlist[count].appendChild(newp);
            }
            count++;
        }
    }).fail(function(res){   //error code
    });
});


$("#querybtn").click(function(){
    var queryArr = JSON.stringify(document.getElementById("queryinput").value.split(" "));
    $.ajax({
        type:"GET",
        //url:"http://alphabetter-v1.herokuapp.com/ALPHABETTER/learnSystem/discovery.php",
        //url:"http://localhost/ALPHABETTER/learnSystem/discovery.php",
        //url:"https://finalpresentation2.mybluemix.net/discovery.php",
        data: {data:queryArr},
        contentType: "application/json"
    }).done(function(res){
        var result = JSON.parse(res);
        var text = result["results"][0]["text"];
        var parentNode = document.getElementById("data");
        while(parentNode.hasChildNodes()){
            parentNode.removeChild(parentNode.firstChild);
        }
        var childElem = document.createElement("h3");
        var childElemNode = document.createTextNode(text);
        childElem.appendChild(childElemNode);
        parentNode.appendChild(childElem);
    }).fail(function(res){
});
    

*/

