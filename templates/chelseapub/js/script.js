/*  Table of Contents
 01. MENU ACTIVATION
 02. GALLERY JAVASCRIPT
 03. FITVIDES RESPONSIVE VIDEOS
 04. MOBILE SELECT MENU
 05. HEADER OPACITY
 06. Scroll to Top
 07. TRANPARENT SLIDER BUTTON + PORTFOLIO
 08. CHECKOUT HOVER
 09. Header Scroll to Fixed Option
 10. PrettyPhoto Activation
 11. Contact Form Validation
 */
/*
 =============================================== 01. MENU ACTIVATION  ===============================================
 */
jQuery(document).ready(function($) {
    'use strict';
    jQuery("ul.sf-menu").supersubs({
        minWidth:    5,   // minimum width of sub-menus in em units
        maxWidth:    25,   // maximum width of sub-menus in em units
        extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                           // due to slight rounding differences and font-family
    }).superfish({
        animationOut:  {opacity:'show'},
        speed:         200,           // speed of the opening animation. Equivalent to second parameter of jQuery’s .animate() method
        speedOut:      'fast',
        autoArrows:    true,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
        dropShadows:   false,               // completely disable drop shadows by setting this to false
        delay:     400               // 1.2 second delay on mouseout
    });
});


/*
 =============================================== 02. GALLERY JAVASCRIPT  ===============================================
 */
jQuery(document).ready(function($) {
    'use strict';
    $('.gallery-progression').flexslider({
        animation: "fade",
        slideDirection: "horizontal",
        slideshow: false,
        slideshowSpeed: 7000,
        animationDuration: 200,
        directionNav: true,
        controlNav: true
    });
});


/*
 =============================================== 03. FITVIDES RESPONSIVE VIDEOS  ===============================================
 */
jQuery(document).ready(function($) {
    'use strict';
    $("body").fitVids();
});


/*
 =============================================== 04. MOBILE SELECT MENU  ===============================================
 */

jQuery(document).ready(function($) {
    $('.sf-menu').mobileMenu({
        defaultText: 'Navigate to...',
        className: 'select-menu',
        subMenuDash: '&ndash;&ndash;'
    });
});



/*
 =============================================== 06. Scroll to Top  ===============================================
 */
jQuery(document).ready(function($) {
    'use strict';
    $(window).scroll(function(){
    });
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 300);
        return false;
    });

});



/*
 =============================================== 07. TRANPARENT SLIDER BUTTON + PORTFOLIO  ===============================================
 */

/*
 jQuery(window).load(function() {
 */

jQuery(document).ready(function($) {
    'use strict';
    $('.portfolio-index-padding').transify({opacityOrig:0.5, percentWidth:'100%'});
});


/*
 });
 */


/*
 =============================================== 08. CHECKOUT HOVER  ===============================================
 */
jQuery(document).ready(function($) {
    'use strict';
    var hide = false;
    $(".cart-hover-div").hover(function(){
        if (hide) clearTimeout(hide);
        $("#checkout-basket-iceberg").fadeIn();
    }, function() {
        hide = setTimeout(function() {$("#checkout-basket-iceberg").fadeOut("slow");}, 250);
    });
    $("#checkout-basket-iceberg").hover(function(){
        if (hide) clearTimeout(hide);
    }, function() {
        hide = setTimeout(function() {$("#checkout-basket-iceberg").fadeOut("slow");}, 250);
    });
});


/*
 =============================================== 09. Header Scroll to Fixed Option  ===============================================
 */
jQuery(document).ready(function($) {
    'use strict';
    $('#pro-header-fixed').scrollToFixed({
        spacerClass: 'pro-header-spacing',
        zIndex:'9999', dontSetWidth:'false'});
});


/*
 =============================================== 10. prettyPhoto Activation  ===============================================
 */
jQuery(document).ready(function($) {
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'fast', /* fast/slow/normal */
        slideshow: 5000, /* false OR interval time in ms */
        autoplay_slideshow: false, /* true/false */
        opacity: 0.80, /* Value between 0 and 1 */
        show_title: false, /* true/false */
        allow_resize: true, /* Resize the photos bigger than viewport. true/false */
        default_width: 500,
        default_height: 344,
        counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
        theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
        horizontal_padding: 20, /* The padding on each side of the picture */
        hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        wmode: 'opaque', /* Set the flash wmode attribute */
        autoplay: false, /* Automatically start videos: True/False */
        modal: false, /* If set to true, only the close button will close the window */
        deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
        overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
        keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
        ie6_fallback: true,
        social_tools: '' /* html or false to disable  <div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div> */
    });
});


/*
 =============================================== 11. Form Validation  ===============================================
 */

jQuery(document).ready(function($) {
    'use strict';
    $("#CommentForm").validate();
});