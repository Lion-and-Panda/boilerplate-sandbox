jQuery(document).ready(function($){
  var $lateral_menu_trigger = $('#lpbp-menu-trigger,#lpbp-menu-trigger-close'),
    $content_wrapper = $('#wrapper'),
    $navigation = $('header'),
    mainHeader = $('.headerMain'),
    belowNavHeroContent = $('.sub-nav-hero'),
    headerHeight = mainHeader.height();

  var scrolling = false,
    previousTop = 0,
    currentTop = 0,
    scrollDelta = 10,
    scrollOffset = 150;


  //open-close lateral menu clicking on the menu icon
  $lateral_menu_trigger.on('click', function(event){
    event.preventDefault();

    $lateral_menu_trigger.toggleClass('is-clicked');
    $lateral_menu_trigger.attr('aria-expanded', 'true');
    $navigation.toggleClass('lateral-menu-is-open');
    $content_wrapper.toggleClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
      // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
      $('body').toggleClass('overflow-hidden');
    });
    $('#lpbp-lateral-nav').toggleClass('lateral-menu-is-open');
    $('#lpbp-lateral-nav').attr("aria-hidden", function (i, attr) {
        return attr == "true" ? "false" : "true";
    });

    //check if transitions are not supported - i.e. in IE9
    if($('html').hasClass('no-csstransitions')) {
      $('body').toggleClass('overflow-hidden');
    }
  });

  //close lateral menu clicking outside the menu itself
  $content_wrapper.on('click', function(event){
    if( !$(event.target).is('#lpbp-menu-trigger, #lpbp-menu-trigger span') ) {
      $lateral_menu_trigger.removeClass('is-clicked');
      $lateral_menu_trigger.attr('aria-expanded', 'false');
      $navigation.removeClass('lateral-menu-is-open');
      $('#lpbp-lateral-nav').attr("aria-hidden", function (i, attr) {
          return attr == "true" ? "false" : "true";
      });
      $content_wrapper.removeClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
        $('body').removeClass('overflow-hidden');
      });
      $('#lpbp-lateral-nav').removeClass('lateral-menu-is-open');
      //check if transitions are not supported
      if($('html').hasClass('no-csstransitions')) {
        $('body').removeClass('overflow-hidden');
      }

    }
  });

  //open (or close) submenu items in the lateral menu. Close all the other open submenu items.
  $('.menu-item-has-children').children('a').on('click', function(event){
    event.preventDefault();
    console.log('click');

    $(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200).end().parent('.menu-item-has-children').siblings('.menu-item-has-children').children('a').removeClass('submenu-open').next('.sub-menu').slideUp(200);
  });

  $("#lpbp-lateral-nav a.closing-tim").click(function(e){
    $lateral_menu_trigger.removeClass('is-clicked');
    $lateral_menu_trigger.attr('aria-expanded', 'false');
    $navigation.removeClass('lateral-menu-is-open');
    $content_wrapper.removeClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
      $('body').removeClass('overflow-hidden');
    });
    $('#lpbp-lateral-nav').removeClass('lateral-menu-is-open');
    //check if transitions are not supported
    if($('html').hasClass('no-csstransitions')) {
      $('body').removeClass('overflow-hidden');
    }
    e.stopPropagation();
  });


  $(window).on('scroll', function(){
    if( !scrolling ) {
      scrolling = true;
      (!window.requestAnimationFrame)
        ? setTimeout(autoHideHeader, 250)
        : requestAnimationFrame(autoHideHeader);
    }
  });

  $(window).on('resize', function(){
    headerHeight = mainHeader.height();
  });

  function autoHideHeader() {
    var currentTop = $(window).scrollTop();

    ( belowNavHeroContent.length > 0 )
      ? checkStickyNavigation(currentTop) // secondary navigation below intro
      : checkSimpleNavigation(currentTop);

       previousTop = currentTop;
    scrolling = false;
  }

  function checkSimpleNavigation(currentTop) {
    //there's no secondary nav or secondary nav is below primary nav
    if (previousTop - currentTop > scrollDelta) {
      //if scrolling up...
      mainHeader.removeClass('is-hidden-nav');
    } else if( currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
      //if scrolling down...
      mainHeader.addClass('is-hidden-nav');
      $('.navbar-dropdown').removeClass('is-open');
    }
  }

//prevent an instance where someone scrolls slow enough to the top to not to trigger the header to appear
  $(document).ready(function() {
  $(window).scroll(function(){
      if ($(this).scrollTop() < 50) {
         $('.headerMain').removeClass('is-hidden-nav');
      }
  });
});

  function checkStickyNavigation(currentTop) {
    //secondary nav below intro section - sticky secondary nav
    var secondaryNavOffsetTop =  mainHeader.height();
    console.log('nav');
    if (previousTop >= currentTop ) {
      //if scrolling up...
      if( currentTop < secondaryNavOffsetTop ) {
        //secondary nav is not fixed
        mainHeader.removeClass('is-hidden-nav');
      } else if( previousTop - currentTop > scrollDelta ) {
        //secondary nav is fixed
        mainHeader.removeClass('is-hidden-nav');
      }

    } else {
      //if scrolling down...
         if( currentTop > secondaryNavOffsetTop + scrollOffset ) {
           //hide primary nav
        mainHeader.addClass('is-hidden-nav');
      } else if( currentTop > secondaryNavOffsetTop ) {
        //once the secondary nav is fixed, do not hide primary nav if you haven't scrolled more than scrollOffset
        mainHeader.removeClass('is-hidden-nav');
      }

    }
  }

});


// make the main menu dropdown clickable instead of hoverable and adding aria tags for accessability
$(document).ready(function() {
  $(".has-dropdown").click(function(){
      // the element that was clicked:
      $(this)
          // finding the first ancestor <div> element:
          .closest('div')
          // finding the descendent '.toggleclass' elements:
          .find('.navbar-dropdown')
         // adding the 'open' class-name:
         .toggleClass('is-open')
         // toggling the aria-hidden attribute on the dropdown submenu
         .attr("aria-hidden", function (i, attr) {
             return attr == "true" ? "false" : "true";
         });

         // toggling the aria-expanded attribute on the dropdown parent item
         $(this).attr("aria-expanded", function (i, attr) {
             return attr == "true" ? "false" : "true";
         });
  });
});

//making the mobile menu accessible with aria tags
$(document).ready(function() {
  // set aria expanded attribute to the dropdown menu parent item
  $('.menu-item-has-children').attr('aria-expanded', 'false');
  //set aria hidden attribute to the dropdown sub menu
  $('.sub-menu').attr('aria-hidden', 'true');

  //find if the dropdown menu parent item has been clicked
  $(".menu-item-has-children").click(function(){
      // the element that was clicked:
      $(this)
          // finding the first ancestor <div> element:
          .closest('div')
          // finding the descendent '.sub-menu' elements:
          .find('.sub-menu')
         // toggling the aria-hidden attribute on the dropdown submenu
         .attr("aria-hidden", function (i, attr) {
             return attr == "true" ? "false" : "true";
         });

         // toggling the aria-expanded attribute on the dropdown parent item
         $(this).attr("aria-expanded", function (i, attr) {
             return attr == "true" ? "false" : "true";
         });
  });
});
