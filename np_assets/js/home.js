$(function(){
    var top = ($(window).height()/2)-($('#intro-section').height()/2);
    var left = ($(window).width()/2)-($('#intro-section').width()/2);
    var distance = top + $('#intro-section').height();
    $('#intro-section').css({top:top,left:left});
    $('#body').css({marginTop:$(window).height() - $('#menu-bar').height()});
    $(window).scroll(function(e){
        $('#intro-section').css({
            top : top - ($(window).scrollTop() / $(document).height() * distance)
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
