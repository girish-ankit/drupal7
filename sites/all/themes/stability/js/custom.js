/**
    * @package Stability Responsive HTML5 Template
    * 
    * Template Scripts
    * Created by Dan Fisher

    Init JS
    
    1. Main Navigation
    2. Isotope
    3. Magnific Popup
    4. Flickr
    5. Carousel (based on owl carousel plugin)
    6. Content Slider (based on owl carousel plugin)
    7. FitVid (responsive video)
    -- Misc
    8. Sticky Header
*/

jQuery(function($){



    /* ----------------------------------------------------------- */
    /*  1. Main Navigation
    /* ----------------------------------------------------------- */


    $(".flexnav").flexNav({
        'animationSpeed':     200,            // default for drop down animation speed
        'transitionOpacity':  true,           // default for opacity animation
        'buttonSelector':     '.navbar-toggle', // default menu button class name
        'hoverIntent':        true,          // Change to true for use with hoverIntent plugin
        'hoverIntentTimeout': 50,            // hoverIntent default timeout
        'calcItemWidths':     false,          // dynamically calcs top level nav item widths
        'hover':              true            // would you like hover support?      
    });


    /* ----------------------------------------------------------- */
    /*  2. Isotope
    /* ----------------------------------------------------------- */

    (function() {


        // Portfolio settings
        var $container          = $('.project-feed');
        var $filter             = $('.project-feed-filter');

        $(window).smartresize(function(){
            $container.isotope({
                filter              : '*',
                resizable           : true,
                layoutMode: 'sloppyMasonry',
                itemSelector: '.project-item'
            });
        });

        $container.imagesLoaded( function(){
            $(window).smartresize();
        });

        // Filter items when filter link is clicked
        $filter.find('a').click(function() {
            var selector = $(this).attr('data-filter');
            $filter.find('a').removeClass('btn-primary');
            $(this).addClass('btn-primary');
            $container.isotope({ 
                filter             : selector,
                animationOptions   : {
                animationDuration  : 750,
                easing             : 'linear',
                queue              : false
                }
            });
            return false;
        });
       
    })();



    /* ----------------------------------------------------------- */
    /*  3. Magnific Popup
    /* ----------------------------------------------------------- */
    $('.popup-link').magnificPopup({
        type:'image',
        // Delay in milliseconds before popup is removed
        removalDelay: 300,

        // Class that is added to popup wrapper and background
        // make it unique to apply your CSS animations just to this exact popup
        mainClass: 'mfp-fade'
    });



    /* ----------------------------------------------------------- */
    /*  4. Flickr
    /* ----------------------------------------------------------- */
    $('.flickr-feed').jflickrfeed({
        limit: 9,
        qstrings: {
            id: Drupal.settings.stability.flickr_id
        },
        itemTemplate: '<li><a href="{{link}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
    }, 
    function(data) {
        $(".flickr-feed li:nth-child(3n)").addClass("nomargin");
    });



    /* ----------------------------------------------------------- */
    /*  5. Carousel (based on owl carousel plugin)
    /* ----------------------------------------------------------- */
    var owl = $("#owl-carousel");

    owl.owlCarousel({
        items : 4, //4 items above 1000px browser width
        itemsDesktop : [1000,4], //4 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // 4 items betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0;
        itemsMobile : [480,1], // itemsMobile disabled - inherit from itemsTablet option
        pagination : false
    });

    // Custom Navigation Events
    $("#carousel-next").click(function(){
        owl.trigger('owl.next');
    });
    $("#carousel-prev").click(function(){
        owl.trigger('owl.prev');
    });



    /* ----------------------------------------------------------- */
    /*  6. Content Slider (based on owl carousel plugin)
    /* ----------------------------------------------------------- */
    Drupal.behaviors.owl_slider = {
        attach: function (context, settings) {
            owl_slider(context);
        }
    };
    function owl_slider(context) {
        $(".owl-slider", context).owlCarousel({
            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem:true,
            navigationText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            pagination: true
        });
    }
    owl_slider($(document));

    /* ----------------------------------------------------------- */
    /*  7. FitVid (responsive video)
    /* ----------------------------------------------------------- */
    Drupal.behaviors.video_fit = {
        attach: function (context, settings) {
          video_fit(context);
        }
    };
    function video_fit(context) {
        $(".video-holder", context).fitVids();
    }
    video_fit($(document));

    /* ----------------------------------------------------------- */
    /*  -- Misc
    /* ----------------------------------------------------------- */

    $('.title-accent > h3').each(function(){
        var me = $(this);
        me.html(me.html().replace(/^(\w+)/, '<span>$1</span>'));
    });

    // Back to Top
    $("#back-top").hide();
    
    if($(window).width() > 991) {
        $('body').append('<div id="back-top"><a href="#top"><i class="fa fa-chevron-up"></i></a></div>')
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function(e) {
            e.preventDefault();
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
    };

    // Animation on scroll
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobile == false) {
        
        $("[data-animation]").each(function() {

        var $this = $(this);

        $this.addClass("animation");

        if(!$("html").hasClass("no-csstransitions") && $(window).width() > 767) {

            $this.appear(function() {

                var delay = ($this.attr("data-animation-delay") ? $this.attr("data-animation-delay") : 1);

                if(delay > 1) $this.css("animation-delay", delay + "ms");
                $this.addClass($this.attr("data-animation"));

                setTimeout(function() {
                    $this.addClass("animation-visible");
                }, delay);

            }, {accX: 0, accY: -170});

        } else {

            $this.addClass("animation-visible");

        }

    });  
    }


    /* ----------------------------------------------------------- */
    /*  8. Sticky Header
    /* ----------------------------------------------------------- */

    // Sticky header on the IE doesn't showing properly
    var ua = window.navigator.userAgent;
    if($('body').hasClass('boxed') && (ua.indexOf("MSIE ") > -1 || ua.indexOf('Trident/') > -1)) {
      return;
    }

    var header = $("header.header"),
        headH = header.height(),
        logoHolder = header.find(".logo"),
        logo = header.find(".logo img"),
        logoW = logo.width(),
        logoH = logo.height(),
        logoSmH = 28,
        $this = this;

    logo.css("height", logoSmH);

    var logoSmW = logo.width();
    logo.css("height", "auto").css("width", "auto");

    $this.stickyHeader = function() {

        if(header.hasClass("header-menu-fullw"))
            return false;

        if($(window).scrollTop() > (headH) && $(window).width() > 991) {

            if($("body").hasClass("sticky-header"))
                return false;

            logo.stop(true, true);

            $("body").addClass("sticky-header").css("padding-top", headH);

            logoHolder.addClass("logo-sticky");

            logo.animate({
                width: logoSmW,
                height: logoSmH
            }, 300, function() {});

        } else {

            if($("body").hasClass("sticky-header")) {

                $("body").removeClass("sticky-header").css("padding-top", 0);

                logoHolder.removeClass("logo-sticky");

                logo.animate({
                    width: logoW,
                    height: logoH,
                }, 300, function() {

                    logo.css({
                        width: "auto",
                        height: "auto"
                    });

                });
            }
        }
    }

    $(window).on("scroll", function() {
        $this.stickyHeader();
    });
    $this.stickyHeader();


    /* ----------------------------------------------------------- */
    /*  9. Shape Boxes
    /* ----------------------------------------------------------- */
    function init() {
        var speed = 250,
            easing = mina.easeinout;

        [].slice.call ( document.querySelectorAll( '.shape-item' ) ).forEach( function( el ) {
            var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
                pathConfig = {
                    from : path.attr( 'd' ),
                    to : el.getAttribute( 'data-path-hover' )
                };

            el.addEventListener( 'mouseenter', function() {
                path.animate( { 'path' : pathConfig.to }, speed, easing );
            } );

            el.addEventListener( 'mouseleave', function() {
                path.animate( { 'path' : pathConfig.from }, speed, easing );
            } );
        } );
    }

    init();


    /* ----------------------------------------------------------- */
    /*  10. SelfHosted Audio & Video
    /* ----------------------------------------------------------- */
    $('audio,video').mediaelementplayer({
        videoWidth: '100%',
        videoHeight: '100%',
        audioWidth: '100%',
        features: ['playpause','progress','tracks','volume'],
        videoVolume: 'horizontal'
    });

    /* ----------------------------------------------------------- */
    /*  11. Masonry Blog
    /* ----------------------------------------------------------- */

    (function() {


        // Portfolio settings
        var $container          = $('.masonry-feed');

        $(window).smartresize(function(){
            $container.isotope({
                resizable           : true,
                layoutMode: 'sloppyMasonry',
                itemSelector: '.masonry-item'
            });
        });

        $container.imagesLoaded( function(){
            $(window).smartresize();
        });
        
       
    })();

    // Parallax Background
    $(window).load(function () {

        if($(".parallax-bg").get(0) && $(window).width() > 991) {
            if(!Modernizr.touch) {
                $(window).stellar({
                    responsive:true,
                    scrollProperty: 'scroll',
                    parallaxElements: false,
                    horizontalScrolling: false,
                    horizontalOffset: 0,
                    verticalOffset: 0
                });
            } else {
                $(".parallax-bg").addClass("disabled");
            }
        }
    });

    // Product Page increase/decrease quantity
    $('.quantity [type="button"]').click(function() {
        var $qty = $(this).parent().find('.qty');
        var new_value = parseInt($qty.val()) + ($(this).val() == '-' ? -1 : +1);
        $qty.val(new_value < 1 ? 1 : new_value);
    });
});