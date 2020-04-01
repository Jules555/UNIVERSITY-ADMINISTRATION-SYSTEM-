$(document).ready(function () {

    //hide the pre loader after pace is done
    Pace.on("done",function () {
        $(".pre-loader").css({display:"none"});
    });


    // owl carousel for image auto change (on header background)
    $(".owl-carousel").owlCarousel({
        items:1,
        loop:true,
        margin:0,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:false,
        animateOut:'fadeOut'
    });

    $(".hero-title").each(function (i) {
        var $current_element = $(this);
        setTimeout(function () {
            $current_element.addClass("reveal");
        },i*500);
    })

    //morphext for auto rotation of text
    $("#rotating-text").Morphext({

        //the animation to be used
        animation:"rubberBand",
        //a separator which separates words to be used
        separator:",",
        //the duration between changing of each words
        speed:3000,

        complete:function () {
            //this one id called after the entrance has been executed

        }

    });

    //magnific pop up to make the images in event section appear in gallery once they are clicked
    $(".gallery").magnificPopup({
        delegate:'a',
        type:'image',
        gallery:{
            enabled:true
        }
    });

    $(window).on("scroll",function () {
        if($(window).scrollTop()>0){
            $(".navbar").addClass("nav-bg-black");
        }
        else {
            $(".navbar").removeClass("nav-bg-black");
        }


    })


});
