
/*----- Menu Stick 上方固定式選單 -----*/

$(document).ready(function() {

    var header = $('.transparent-bar');
    var win = $('.wrapper');
    
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass('stick');
        } else {
            header.addClass('stick');
        }
    });
})

