$(document).ready(function($) {
    "use strict";

    /************************************
        Header
    *************************************/
    //Search
    $('#search .search-btn').on('click', function(event) {
        event.preventDefault();
        $('#search-full').fadeIn('300').show();
        $('#exit-search-box').on('click', function(event) {
            event.preventDefault();
            $('#search-full').fadeOut('300', function() {
                $(this).hide();
            });;
        });
    });
    //Navigation
    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            $("header .header-wrapper").css({
                padding: '10px 0',
            });
        }
        else {
            $("header .header-wrapper").css({
                padding: '25px 0',
            });
        }
    });
    // Mobile submenu open
    $('.submenu-opener').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('fa-plus fa-minus');
        $(this).next().slideToggle()
    });
    // Click to open sidebar menu
    $('#showMenu').on('click', function(event) {
        event.preventDefault();
        $('header').append('<div id="overlay"></div>')
        $('.navigation').css({
            left: '0%',
            visibility: 'visible',
        });
        $('#overlay').on('click', function(event) {
            $(this).remove();
            $('.navigation').css({
                left: '-100%',
                visibility: 'hidden',
            });
        });
    });
    // Mobile Navigation
    (function($) {
        function mediaSize() { 
            if (window.matchMedia('(min-width: 1200px)').matches) {
                $('.navigation').removeAttr('style')
                $('.navigation .sub-menu').removeAttr('style')
                $('#overlay').remove()
                $('header').removeClass('mobile')
            }
            else {
                $('header').addClass('mobile')
            }
        };
        mediaSize();
        window.addEventListener('resize', mediaSize, false);  
    })(jQuery); 

    /************************************
        Click to scroll up init
    *************************************/
    $.scrollUp({
        scrollDistance: 300,
        scrollText: "<svg style='position: relative; bottom: 1px;' height='11px' version='1.1' viewBox='0 0 20 11' width='14px' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'> <g fill='none' fill-rule='evenodd' id='Page-1' stroke='none' stroke-width='1'> <g fill='#FFFFFF' id='Dribbble-Light-Preview' transform='translate(-260.000000, -6684.000000)'> <g id='icons' transform='translate(56.000000, 160.000000)'> <path d='M223.707692,6534.63378 L223.707692,6534.63378 C224.097436,6534.22888 224.097436,6533.57338 223.707692,6533.16951 L215.444127,6524.60657 C214.66364,6523.79781 213.397472,6523.79781 212.616986,6524.60657 L204.29246,6533.23165 C203.906714,6533.6324 203.901717,6534.27962 204.282467,6534.68555 C204.671211,6535.10081 205.31179,6535.10495 205.70653,6534.69695 L213.323521,6526.80297 C213.714264,6526.39807 214.346848,6526.39807 214.737591,6526.80297 L222.294621,6534.63378 C222.684365,6535.03868 223.317949,6535.03868 223.707692,6534.63378' id='arrow_up-[#337]'></path> </g> </g> </g> </svg>",
        scrollSpeed: 800,
    });
        

    /**
     * Comment Javascript 
     */
    $("a.comment-reply-link").click(function () {
        var id = $(this).attr("data-comment-id");
        var commentid = $(this).attr("comment-id");
        $("#parent").attr("value", id);
        $("#"+commentid).parent().after($("#form-comment").addClass('has-children'));
        $(".new-comment").show();
    });
    $(".new-comment").click(function(){
        $("#post-comment").after($("#form-comment").removeClass('has-children'));
        $("#parent").val('');
        $(this).hide();
    })

});
