(function($) {

    // ===============================================
    // STICKY HEADER / SIDEBAR
    // ===============================================
    jQuery("document").ready(function($){

        sticky_menu();

        function sticky_menu() {

            hasScrolled();

            var didScroll;
            var lastScrollTop = 0;
            var navbarHeight = $('header.header').outerHeight();
            var delta = navbarHeight;

            $(window).scroll(function (event) {
                didScroll = true;
            });

            setInterval(function () {
                if (didScroll) {
                    hasScrolled();
                    didScroll = false;
                }
            }, 250);

            function hasScrolled() {
                var st = $(this).scrollTop();

                // Make scroll more than delta
                if (Math.abs(lastScrollTop - st) <= delta)
                    return;

                // If scrolled down and past the navbar, add class .nav-up.
                if (st > lastScrollTop && st > navbarHeight) {
                    // Scroll Down
                    $('header.header').removeClass('not-sticky reset').addClass('sticky');

                } else {
                    if (st >= 0 && st <= 150) {
                        $('header.header').addClass('reset').removeClass('not-sticky sticky');

                    } else if (st + $(window).height() < $(document).height()) {
                        $('header.header').removeClass('not-sticky reset').addClass('sticky');
                    }
                }

                lastScrollTop = st;
            }

        }

    });


    // -----------------------------------------------------------------------------
    // MOBILE MENU
    // -----------------------------------------------------------------------------

    jQuery(document).ready(function($){

        var scrollPosition = '0';

        // Hamburger menu animation
        var menuAnimation = $('#nav_mobile').attr('data-menu-mobile-anim');
        var header_height = $('.header').outerHeight();

        $('#site-navigation').addClass(menuAnimation);
        $("nav.header-nav > ul").css('margin-top', header_height);


        $("#nav_mobile").click(function() {

          const $body = document.querySelector('body');
          const $html = document.querySelector('html');
          const siteNavigation = document.querySelector('#site-navigation')

          // Remove style for desktop
          var resizeId;
          function doneResizing(){
            var windowWidth = $(window).width();
            if(windowWidth > 1024){
              $("nav.mmenu-active .menu-item-has-children > a").removeClass('submenu-visible');
              $html.style.removeProperty('overflow');
              $body.style.removeProperty('position');
              $body.style.removeProperty('top');
              $("ul.sub-menu").removeAttr('style');
            }
          }


          // Deactivate menu
            if ($(this).attr('menu-mobile') == 'active') {

              $(this).attr('menu-mobile', 'not-active');

              $html.style.removeProperty('overflow');
              $body.style.removeProperty('position');
              $body.style.removeProperty('top');
              $body.style.removeProperty('width');

              window.scrollTo(0, scrollPosition);

              $('header.header').removeClass('hamb-open');

              // Control the aria expanded for site menu
              siteNavigation.setAttribute("aria-expanded", 'false');

          }

          // Activate menu
            else {

              $('header.header').addClass('hamb-open');


              $(window).resize(function() {
                  clearTimeout(resizeId);
                  resizeId = setTimeout(doneResizing, 200);
              });


              $(this).attr('menu-mobile', 'active');
              scrollPosition = window.pageYOffset

              $html.style.overflow = 'hidden';
              $body.style.position = 'fixed';
              $body.style.top = "-"+scrollPosition+"px";

              // Control the aria expanded for site menu
              siteNavigation.setAttribute("aria-expanded", 'true');

          }

          $('html').toggleClass('menu-opened');
          $(this).prev().toggleClass('mmenu-active');


          // Open submenu with current subpage when collapsed option is selected
          if ($('.header-nav').hasClass('collapsed')) {
            $('nav.mmenu-active.collapsed .current-menu-parent a').addClass('submenu-visible');
            $('nav.mmenu-active.collapsed .current-menu-parent ul.sub-menu').slideDown(400);
          }


        });

      });


      // Accordion for sub menus
      $(document).on('click', "nav.mmenu-active.collapsed.clickable .menu-item-has-children > a", function() {
          event.preventDefault();
          $(this).toggleClass('submenu-visible');
          $(this).next( 'ul.sub-menu' ).slideToggle(400);
      });

      $(document).on('click', "nav.mmenu-active.collapsed.not-clickable .menu-item-has-children", function() {
        if (event.target !== this)
        return;
        event.stopPropagation();
        event.preventDefault();
        $(this).find( '> a' ).toggleClass('submenu-visible');
        $(this).find( 'ul.sub-menu' ).slideToggle(400);
      });




    // -----------------------------------------------------------------------------
    // b2t
    // -----------------------------------------------------------------------------
    jQuery(document).ready(function($){
        var offset = 300,
            offset_opacity = 1200,
            scroll_top_duration = 700,
            $back_to_top = $('.cd-top');

        //hide or show the "back to top" link
        $(window).scroll(function(){
            ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
            if( $(this).scrollTop() > offset_opacity ) {
                $back_to_top.addClass('cd-fade-out');
            }
        });

        //smooth scroll to top
        $back_to_top.on('click', function(event){
            event.preventDefault();
            $('body,html').animate({
                scrollTop: 0 ,
                }, scroll_top_duration
            );
        });
    });

    // -----------------------------------------------------------------------------
    // IFRAME RESIZE
    // -----------------------------------------------------------------------------
    window.addEventListener('message', function(event) {
        var frames = document.getElementsByTagName('iframe');
        for (var i = 0; i < frames.length; i++) {
            if (frames[i].contentWindow === event.source) {
                $(frames[i]).height(event.data + 10);
                break;
            }
        }
    });

    // -----------------------------------------------------------------------------
    // ACCORDION
    // -----------------------------------------------------------------------------
    jQuery(document).ready(function($){
        var accordion_container = $('.accordion > .wp-block-group__inner-container');
        var headings = accordion_container.children('h3');
        var panels = accordion_container.children('.wp-block-group');
        panels.not('.open').hide();

        headings.click(function() {
            if($(this).hasClass('open'))
            {
                $(this).removeClass('open');
                $(this).next().slideUp();
                $(this).next().removeClass('open');
            }
            else
            {
                panels.slideUp();
                panels.removeClass('open');
                headings.removeClass('open');

                $(this).addClass('open');
                $(this).next().slideDown();
                $(this).next().addClass('open');
            }

            return false;
        });
    });

    // -----------------------------------------------------------------------------
    // CHILD PAGES WIDGET
    // -----------------------------------------------------------------------------
    jQuery(document).ready(function($){
        $('select#child_pages').change(function(){
            location.href = $(this).val();
        });
    });

    // Adjust banner heading margin based on header height:

    jQuery(document).ready(function($){

        var header_height = $('.header').outerHeight();

        $('.banner-overlay h1').css('margin-top', header_height);

    });

    


    // -----------------------------------------------------------------------------
    // IMAGE LIGHTBOX 
    // Use '.lightbox' class on image block to activate
    // CSS is in the ./base/_utilities.scss file. I've used basic animation but feel free to spice things up!
    // -----------------------------------------------------------------------------
    jQuery(document).ready(function ($) {

        $(".lightbox").click(function () {

            var src = $(this).find('img').attr('src');
            var alt = $(this).find('img').attr('alt');

            if (document.querySelector('.img-lightbox') !== null) {
                // .. it exists
                createLightbox(src, alt);
            }else{
                //  .. it doesn't exist, so create the element.
                $( '<div class="img-lightbox"><div class="closeLightbox"><i class="fas fa-times"></i></div><img src="/"/></div>' ).appendTo( "body" );
                // Timeout required to enable animation. Even just 1 milisecond is enough.
                setTimeout(
                    function() 
                    {
                      createLightbox(src, alt);
                    }, 1);
            }

        });
        
        function createLightbox(src, alt){

            $('.img-lightbox img').attr('src', src);
            $('.img-lightbox img').attr('alt', alt);

            $('.img-lightbox').toggleClass('active');

            $('.img-lightbox, .closeLightbox').click(function(){
                $('.img-lightbox').removeClass('active');
            });
            
            $('.img-lightbox img').click(function (e) {
                e.stopPropagation();
            });
        }

    });

    jQuery(document).ready(function($){

        $('.search-trigger').click(function(){
            headerSearch()
        });

        $('.search-overlay').click(function(){
            headerSearch()
        });

        $('#nav_mobile').click(function(){
            if($('.header').hasClass('search-active')){
                $('.header').removeClass('search-active');
                $('.search-overlay').removeClass('active');
            }    
        });

        function headerSearch(){
            if($('.header').hasClass('search-active')){
                $('.header').removeClass('search-active');
                $('.search-overlay').removeClass('active');
            }else{
                $('.header').addClass('search-active');
                $('.search-overlay').addClass('active');
                setTimeout(function() {$('#s').val() = ''}, 400);
                setTimeout(function() {$('#s').focus()}, 450);
            }
        }

    });

    $(document).keyup(function(e) {
        if (e.key === "Escape") { // escape key maps to keycode `27`
            if($('.header').hasClass('search-active')){
                $('.header').removeClass('search-active');
                $('.search-overlay').removeClass('active');
            }       
        }
   });


})( jQuery );
