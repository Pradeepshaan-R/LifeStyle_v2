
$(function($) {

    "use strict";

    //===== 01. Main Menu
    function mainMenu() {
        // Variables
        var var_window = $(window),
            navContainer = $('.nav-container'),
            pushedWrap = $('.nav-pushed-item'),
            pushItem = $('.nav-push-item'),
            pushedHtml = pushItem.html(),
            pushBlank = '',
            navbarToggler = $('.navbar-toggler'),
            navMenu = $('.nav-menu'),
            navMenuLi = $('.nav-menu ul li ul li'),
            closeIcon = $('.navbar-close');
        // navbar toggler
        navbarToggler.on('click', function() {
            navbarToggler.toggleClass('active');
            navMenu.toggleClass('menu-on');
        });
        // close icon
        closeIcon.on('click', function() {
            navMenu.removeClass('menu-on');
            navbarToggler.removeClass('active');
        });

        // adds toggle button to li items that have children
        navMenu.find('li a').each(function() {
            if ($(this).next().length > 0) {
                $(this)
                    .parent('li')
                    .append(
                        '<span class="dd-trigger"><i class="fas fa-angle-down"></i></span>'
                    );
            }
        });
        // expands the dropdown menu on each click
        navMenu.find('li .dd-trigger').on('click', function(e) {
            e.preventDefault();
            $(this)
                .parent('li')
                .children('ul')
                .stop(true, true)
                .slideToggle(350);
            $(this).parent('li').toggleClass('active');
        });

        // check browser width in real-time
        function breakpointCheck() {
            var windoWidth = window.innerWidth;
            if (windoWidth <= 1199) {
                navContainer.addClass('breakpoint-on');

                pushedWrap.html(pushedHtml);
                pushItem.hide();
            } else {
                navContainer.removeClass('breakpoint-on');

                pushedWrap.html(pushBlank);
                pushItem.show();
            }
        }

        breakpointCheck();
        var_window.on('resize', function() {
            breakpointCheck();
        });
    };
    // Document Ready
    $(document).ready(function() {
        mainMenu();
    });

    //===== Prealoder
    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut('500');
    })

    //===== Sticky
    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 190) {
            $(".header-navigation").removeClass("sticky");
        } else {
            $(".header-navigation").addClass("sticky");
        }
    });

    //====== Sidebar menu
    $.sidebarMenu = function(menu) {
      var animationSpeed = 300,
      subMenuSelector = '.sub-menu';
      $(menu).on('click', 'li a', function(e) {
        var $this = $(this);
        var checkElement = $this.next();

        if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
          checkElement.slideUp(animationSpeed, function() {
            checkElement.removeClass('menu-open');
          });
          checkElement.parent("li").removeClass("active");
        }
        //If the menu is not visible
        else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
          var parent = $this.parents('ul').first();
          var ul = parent.find('ul:visible').slideUp(animationSpeed);
          ul.removeClass('menu-open');
          var parent_li = $this.parent("li");
          checkElement.slideDown(animationSpeed, function() {
            checkElement.addClass('menu-open');
            parent.find('li.active').removeClass('active');
            parent_li.addClass('active');
          });
        }
        if (checkElement.is(subMenuSelector)) {
          e.preventDefault();
        }
      });
    };

    $(".menu-icon,.cross-icon,.panel-overly").on('click', function (e) {
      e.preventDefault();
      $(".sidebar-sidemenu").toggleClass("active");
    });
    $.sidebarMenu($('.sidebar-menu'))

    //====== Magnific Popup
    $('.video-popup').magnificPopup({
        type: 'iframe'
        // other options
    });
    $('.img-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    //===== Back to top
    $(window).on('scroll', function(event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });

    //Animate the scroll to top
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });

    // jquery nice select js
    $('select').niceSelect();

    // nice number
    $('input[type="number"]').niceNumber({
      buttonDecrement:'<i class="fal fa-minus"></i>',
      buttonIncrement:'<i class="fal fa-plus"></i>'
    });

    // Product Quantity
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 300,
      values: [ 5, 200 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    
    //=====  Slick Slider js
    $('.hero-contnt-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 500,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.hero-slide-two').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 500,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.hero-slide-three').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 500,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.company-slide').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        prevArrow: '<div class="prev"><i class="fal fa-arrow-left"></i></div>',
        nextArrow: '<div class="next"><i class="fal fa-arrow-right"></i></div>',
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.best-slide').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: true,
        prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
        nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
        Speed: 2500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.trendy-slide').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: true,
        prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
        nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
        Speed: 2500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    var sliderArrows = $('.arrows');
    $('.popular-slide').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        appendArrows: sliderArrows,
        prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
        nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.offer-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.offer-slide-two').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.testimonial-thumb-slide').slick({
        dots: true,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        asNavFor: '.testimonial-slide-one',
        focusOnSelect: true,
        slidesToShow: 3,
        slidesToScroll: 1
    });
    $('.testimonial-slide-one').slick({
        dots: true,
        arrows: false,
        infinite: true,
        autoplay: true,
        asNavFor: '.testimonial-thumb-slide',
        Speed: 2500,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.testimonial-slide-two').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.testimonial-slide-three').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.features-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.service-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.sponsor-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        Speed: 2500,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.shop_big_slide').slick({
      dots: false,
      arrows: false,
      infinite: true,
      autoplay: true,
      Speed: 2500,
      asNavFor: '.shop_thumb_slide',
      slidesToShow: 1,
      slidesToScroll: 1
    });
    $('.shop_thumb_slide').slick({
      dots: false,
      arrows: false,
      infinite: true,
      asNavFor: '.shop_big_slide',
      autoplay: true,
      Speed: 2500,
      focusOnSelect: true,
      slidesToShow: 3,
      slidesToScroll: 1
    });
    $('#gallery-filter').imagesLoaded( function() {
        // items on button click
        $('.filter-btn').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            items.isotope({
                filter: filterValue
            });
        });
        // menu active class
        $('.filter-btn li').on('click', function (e) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        var items = $('.product-items').isotope();
    });
    $('#simple-timer,#simple-timer-two').syotimer({
        year: 2022,
        month: 12,
        day: 31,
        hour: 20
    });
});