$(function(){
    var top = ($(window).height()/2)-($('#intro-section').height()/2);
    var left = ($(window).width()/2)-($('#intro-section').width()/2);
    
    $('#intro-background').width($(window).width()).height($(window).height());
    
    var distance = top + $('#intro-section').height();
    $('#intro-section').css({top:top,left:left});
    $('#body').css({marginTop:$(window).height() - $('#menu-bar').height()});
    $(window).scroll(function(e){
        $('#intro-section').css({
            top : top - ($(window).scrollTop() / $(document).height() * distance * 1.5)
        });
        $('#intro-background').css({
            top : 0 - ($(window).scrollTop() / $(document).height() * distance * 0.8)
        });
        console.log($(window).scrollTop(), $(window).height());
        if($(window).scrollTop() > $(window).height() - $('#menu-bar').height())
        {
            $('#menu-bar').css({top:'0px', position:'fixed', zIndex:2000, width:'100%'});
        }
        else
        {
            $('#menu-bar').css({position:'relative'});
        }
    });
});
