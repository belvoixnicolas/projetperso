jQuery(document).ready(function(){
    $('#tips, #projet div').hide();

    $('#bouton_projet').click(function() {
        var projet = document.getElementById('projet').style.display;
        
        if (projet == 'none') {
            $('#tips').animate({opacity: '0'}, 'slow', function () {
                $('#tips').hide();
                $('#projet').show();
                $('#projet').fadeTo(0, 0);
                $('#projet').animate({opacity: '1'}, 'slow');
            });
        }
    });

    $('#bouton_tips').click(function() {
        var tips = document.getElementById('tips').style.display;
        
        if (tips == 'none') {
            $('#projet').animate({opacity: '0'}, 'slow', function () {
                $('#projet').hide();
                $('#tips').show();
                $('#tips').fadeTo(0, 0);
                $('#tips').animate({opacity: '1'}, 'slow');
            });
        }
    });

    $('#projet section').mouseenter(function() {
        $(this).find("div").show().fadeTo(0, 0).animate({opacity: '1'}, 'slow');
    });
    $('#projet section').mouseleave(function() {
        $(this).find("div").animate({opacity: '0'}, 'slow', function() {
            $(this).hide();
        });
    });

    $('.scroller').click(function() {
        $('header').animate({height: 'toggle'}, 'slow');
    });

    $(window).scroll(function() {
        var header = document.getElementsByTagName('header')[0].style.display;
        
        if (header != 'none') {
            $('header').hide(1000);
        }
    });
});