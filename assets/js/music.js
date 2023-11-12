function startMusic() {
    var selecteItem = document.getElementById("music");
    var index = selecteItem.selectedIndex;
    var selectedMusic = selecteItem.options[index].value;
    myMusic = new sound(selectedMusic);
    myMusic.play();
}

function sound(src) {
    this.sound = document.createElement("audio");
    this.sound.src = src;
    this.sound.setAttribute("preload", "auto");
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    document.body.appendChild(this.sound);
    this.play = function(){
        this.sound.play();
    }
    this.stop = function(){
        this.sound.pause();
    }    
}