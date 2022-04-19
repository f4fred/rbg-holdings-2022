/*------------------------------------------
* BLOCKS FRONTEND
*------------------------------------------ */
(function($) {

    /*------------------------------------------
    * BLOCKS FRONTEND: STRETCH ROW
    *------------------------------------------*/
   jQuery("document").ready(function($){
        
        var viewportWidth = document.querySelectorAll(".alignfull");
        
        var setMargin = function setMargin() {
            requestAnimationFrame(function () {
                [].forEach.call(viewportWidth, function (e) {
                e.style.marginLeft = "";
                e.style.marginLeft = -e.offsetLeft + "px";
                e.style.width = document.body.clientWidth + "px";
                });
            });
        };
        
        setMargin();
        window.onresize = setMargin;

    });

    /*------------------------------------------
    * BLOCKS FRONTEND: IMAGE SLIDER
    *------------------------------------------*/
   jQuery("document").ready(function($){

        $('.image-slider ul').slick({
            infinite: true,
            prevArrow: '',
            nextArrow: '',
            dots: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 550,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                },
                {
                  breakpoint: 1100,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                }
            ]


        });

        /*------------------------------------------
        * BLOCKS FRONTEND: FANCYBOX
        *------------------------------------------*/
        $('[data-fancybox], .image-slider ul li a').fancybox({
            beforeShow: function(){
               $("html").addClass( "fancybox-header" );
               $( "body" ).addClass( "ie-fancybox-body" );
              },
              afterClose: function(){
               $("html").removeClass( "fancybox-header" );
               $( "body" ).removeClass( "ie-fancybox-body" );
              }
        });

        /*------------------------------------------
        * BLOCKS FRONTEND: RELOAD IFRAME ON TAB CHANGE
        *------------------------------------------*/
        jQuery(document).ready(function($){
    
            $('.kt-tabs-title-list li a').on('click', function() {
                if ($(window).width() < 500) {
                  tabIndex = $(this).data('tab');
                  iframe = $('.kt-tabs-content-wrap .kt-inner-tab-'+tabIndex).find('iframe');
                  var src = $(iframe).attr('src');
                  if (src !== undefined) {
                    $(iframe).attr('src', src);
                       console.log('iframe reloaded');
                  }
                }
              });
    
        });
        
        /*------------------------------------------
        * BLOCKS FRONTEND: CALENDAR ADDITIONAL CONTENT ACCORDIAN
        *------------------------------------------*/
        jQuery(document).ready(function($){
    
          $('.calendar-container .additional-info.click').click(function(){
            if($(this).hasClass('open')){
              $(this).removeClass('open');
            }else{
              $(this).addClass('open');
            }
          });
          
        });
      
        /*------------------------------------------
        * BLOCKS FRONTEND: TEAM GRID FUNCTION
        *------------------------------------------*/
                jQuery(document).ready(function($){

                  $('.team-member-grid').click(function(){

                    var posFix = $(this).position().left;
                    
                    $(this).find('.bio').css('transform','translateX(-' + posFix + 'px)');

                    if($('.bio').is(':hidden')){
                      $('.bio').slideUp();
                      $(this).removeClass('active');
                      if($(this).find('.bio').is(':hidden')){
                        $(this).find('.bio').slideDown();
                        $(this).addClass('active');
                      }
                    }else{
                      $(this).find('.bio').slideUp();
                    }
                    
                  });
                  
                });
              
                $( window ).resize(function() {
                  if($('.team-member-grid')[0]){
                    var posFix = $('.team-member-grid').position().left;
                    $('.team-member-grid .bio').css('transform','translateX(-' + posFix + 'px)');
                  }

                });
    });


})( jQuery );