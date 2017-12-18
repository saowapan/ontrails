/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.



(function($) {
    // edit text button
    $('body.single-product .detail-product-woocommerce form.variations_form .single_variation_wrap .variations_button button').html('BUY NOW');
    // Enter send form 
    /*$("#id_of_textbox").keyup(function(event){
        if(event.keyCode === 13){
            $("#id_of_button").click();
        }
    });*/


    //fading on header home page
    var fadeStart=100; 
    var fadeUntil=400; 
    var fading = $('#fading');
    var fading_2 = $('#fading_2');
    var d_fading = $('.d-fading');
    var d_fading_home =$('.d-fading-home');
    var d_fading_map =$('.d-fading-map');
    var parallax = $('.parallax');
    $(window).bind('scroll', function(){
        var offset = $(document).scrollTop();
        var opacity=0;

        var elBackgrounPos= "50% 50%",windowYOffset = window.pageYOffset;
        elBackgrounPos = "50% " + (windowYOffset * 0.5) + "px";
        parallax.css('background-position',elBackgrounPos); 

        if( offset<=fadeStart ){
            opacity=1;
        }else if( offset<=fadeUntil ){
            opacity=1-offset/fadeUntil;
        }
        fading.css('opacity',opacity); 
        fading_2.css('opacity',opacity); 

  
        var display ='inline-block';
        if (offset >= 200) {
          display = 'none';
        }
        d_fading.css('display',display);

        //home // map
        var display_home ='inline-block';
        var display_map ='block';
        if (offset >= 400) {
          display_home = 'none';
          display_map = 'none';
        }
        d_fading_home.css('display',display_home);
        d_fading_map.css('display',display_map);

    });

    $(".journeys-slider-home").slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 576,
          settings: {
            infinite: false,
            slidesToShow: 1,
            centerMode: true,
            centerPadding: '20px',
          }
        }
      ]
    });
    $(".journeys-slider").slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 576,
          settings: {
            infinite: false,
            slidesToShow: 1,
            centerMode: true,
            centerPadding: '20px',
          }
        }
      ]
    });
    $('.slider-hover').slick({
      dots: false,
      arrows: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 600,
      fade: true,
      cssEase: 'linear'
    });
})(jQuery);



(function($) {
  $(document).ready(function(){
  var myNavBar = {
      flagAdd: true,
      elements: [],
      init: function (elements) {
        this.elements = elements;
      },
      add : function() {
        if(this.flagAdd) {
          for(var i=0; i < this.elements.length; i++) {
            document.getElementById(this.elements[i]).className += " fixed-theme";
          }
          this.flagAdd = false;
        }
      },
      remove: function() {
        for(var i=0; i < this.elements.length; i++) {
          document.getElementById(this.elements[i]).className = document.getElementById(this.elements[i]).className.replace( /(?:^|\s)fixed-theme(?!\S)/g , '' );
        }
        this.flagAdd = true;
      }
  };

  myNavBar.init(["header"]);

  function offSetManager(){
    var yOffset = 0;
    var currYOffSet = window.pageYOffset;
    if(yOffset < currYOffSet) {
      myNavBar.add();
    }
    else if(currYOffSet === yOffset){
      myNavBar.remove();
    }
  }

  window.onscroll = function(e) {
    offSetManager();
  };

  offSetManager();
  });  
})(jQuery);