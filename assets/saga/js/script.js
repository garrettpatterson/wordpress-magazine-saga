(function (e) {
    "use strict";
    var n = window.SAGA_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#saga-header").addClass("nav-affix") : e("#saga-header").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow()
            },
            toggleMenu: function () {
                e('#saga-header').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                        e("#saga-header").removeClass('mmenu-active');
                    } else {
                        ethis.slideDown('300');
                        e("#saga-header").addClass('mmenu-active');
                    }
                    e('.ham').toggleClass('exit');
                });
                e('#saga-header .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                    }
                }
            },
            menuArrow: function () {
                if (e('#saga-header .main-navigation div.menu > ul').length) {
                    e('#saga-header .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="ion-ios-arrow-down">');
                }
            }
        },

        n.SagaSearch = function () {
            e(".search-button").click(function () {
                e(".search-box").slideToggle("500");
            });

            e('.search-button').click(function () {
                e(this).toggleClass('active');
            });
        },

        n.SageOffNav = function () {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'left'
            });

            e('.sidr-class-sidr-button-close').click(function (event) {
                event.preventDefault();
                e.sidr('close', 'sidr-nav');
            });
        },
		/*
        n.SagePreloader = function () {
            var typed = new Typed('#loader-typed', {

                stringsElement: '#loader-typed-strings',
                backDelay: 180,
                typeSpeed: 190,
                loop: true

            });

            // loader Check

            var win = e(window);

            win.on('load',function() {

                e('#loader').delay(1500).fadeOut('slow', function(){
                    e('#loader').remove();
                });

            });
        },
		*/
        n.SageSlider = function () {
            e(".saga-slide").owlCarousel({
                loop: (e('.saga-slide').children().length) != 1,
                autoplay: 5000,
                nav: true,
                navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
                items: 1
            });

            e(".saga-widget-slide").owlCarousel({
                loop: (e('.saga-slide').children().length) != 1,
                autoplay: 5000,
                nav: true,
                navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
                items: 1
            });

            e(".gallery-columns-1").owlCarousel({
                loop: (e('.gallery-columns-1').children().length) != 1,
                margin: 3,
                autoplay: 5000,
                nav: true,
                navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
                items: 1
            });
        },

        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {

                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e(".scroll-up").fadeIn(300);
            } else {
                e(".scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e(".scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 700);
                return false;
            });
        },

        n.ms_masonry = function () {
            var econtainer = e('.masonry-grid');
            econtainer.imagesLoaded(function () {
                econtainer.masonry({
                    itemSelector: '.masonry-item',
                    gutter: 30,
                    percentPosition: true,
                })
            });
        },


        e(document).ready(function () {
            n.mobileMenu.init(), n.SagaSearch(), n.SageOffNav()//, n.SagePreloader()
				, n.SageSlider(), n.DataBackground(), n.scroll_up(), n.ms_masonry();
        }),
        e(window).scroll(function () {
            n.stickyMenu(), n.show_hide_scroll_top();
        }),
        e(window).resize(function () {
            n.mobileMenu.menuMobile();
        })
})(jQuery);