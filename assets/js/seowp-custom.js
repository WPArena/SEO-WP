jQuery(document).ready(function ($) {
    var preloader_is_remove = false;

    $(window).load(function () {
        preloader_is_done();
    });

    setTimeout(preloader_is_done, 1000);

    function preloader_is_done() {
        if (!preloader_is_remove) {
            preloader_is_remove = true;

            $('#page').animate({opacity: 1});
            $('#preloader').fadeOut();
        }
    }


    $('.side-nav').attr('id', 'side-primary-menu');

    // Sidenav
    $(".button-collapse").sideNav();

    $("#search-btn a").on('click', function (e) {
        e.preventDefault();
        $("#search-box").show().animate({
            width: $("#search-box").parent().width(),
            opacity: 1
        }, 300, function () {
            $(this).width('100%');
            $("#s").focus();
            $("#s").val($("#s").val());
            $(document).bind('click.hide-search', hideSearch);
            $(".button-collapse").css("visibility", "hidden");
        });
    });

    $("#search-box .mdi-navigation-close").on('click', function (e) {
        e.preventDefault();

        if ($("#s").val() == '') {
            $("#search-box").animate({
                width: 0,
                opacity: 0
            }, 300, function () {
                $(this).hide();
                $(document).unbind('click.hide-search', hideSearch);
                $(".button-collapse").css("visibility", "visible");
            });
        }

        $("#s").val('');
    });

    $("#search-box .mdi-action-search").on('click', function (e) {
        e.preventDefault();
        if ($("#s").val()) {
            $("#search-box").submit();
        } else {
            $("#s").focus();
        }
    });

    $('#s').on('input', function (e) {
        onSearch();
    });
    onSearch();

    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            $("#search-box").animate({
                width: 0,
                opacity: 0
            }, 300, function () {
                $(this).hide();
                $(document).unbind('click.hide-search', hideSearch);
                $(".button-collapse").css("visibility", "visible");
            });
        }
    });

    function hideSearch(e) {
        if ($(e.target).attr('id') != 's' && !$(e.target).hasClass('mdi-navigation-close') && !$(e.target).hasClass('mdi-action-search')) {
            $("#search-box").show().animate({
                width: 0,
                opacity: 0
            }, 300, function () {
                $(this).hide();
                $(document).unbind('click.hide-search', hideSearch);
                $(".button-collapse").css("visibility", "visible");
            });
        }
    }

    function onSearch() {
        if ($("#s").val()) {
            $("#search-box").addClass("on-search");
        } else {
            $("#search-box").removeClass("on-search");
        }
    }

    /**
     * Go to top
     */
    // Hide button
    button = $(".to-top a");
    if ($(window).scrollTop() == 0) {
        button.hide();
    }
    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            button.fadeIn();
        } else {
            button.fadeOut();
        }
    });

    //Click event to scroll to top
    button.click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    /**
     * Menu item waves effect
     */
    $('.menu-item a').addClass('waves-effect waves-light');

    $('.primary-menu .menu-item.menu-item-has-children').hover(function () {
        var $sub_menu = $(this).children('.sub-menu');
        $sub_menu.stop(true, false).slideDown(250, 'linear');
    }, function () {
        var $sub_menu = $(this).children('.sub-menu');
        $sub_menu.stop(true, false).slideUp(250, 'linear');
    });

    /**
     * Materialize Select
     */
    $('select').material_select();

///////////////////Check For Dark Colors

    var c=$(".site-footer").css("background-color");

    var hexDigits = new Array
            ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

    //Function to convert rgb color to hex format
    function rgb2hex(rgb) {
     rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
     return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }

    function hex(x) {
      return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
     }

    var d = rgb2hex(c);
    var c = d.substring(1);      // strip #
    var rgb = parseInt(c, 16);   // convert rrggbb to decimal
    var r = (rgb >> 16) & 0xff;  // extract red
    var g = (rgb >>  8) & 0xff;  // extract green
    var b = (rgb >>  0) & 0xff;  // extract blue

    var luma = 0.2126 * r + 0.7152 * g + 0.0722 * b; // per ITU-R BT.709

    if (luma < 40) {
       $("form .select-wrapper span.caret").css("color","white");
    }
    else{
        $("form .select-wrapper span.caret").css("color","black");
    }

///////////////////Check For Dark Colors END  //////////////////////////

////////////////// If 1 Post IN A Row Then Featured Image/////////////////////
    $( ".content-area .site-main div:has(.m12) img").css('height','100%') ;
    $( ".content-area .site-main div:has(.m12) img").css('top','-150px') ;
////////////////// If 1 Post IN A Row Then Featured Image END/////////////////////

});
