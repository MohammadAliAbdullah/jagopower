$(document).ready(function(){
  
  /** Sticky Header js **/

  var header = $('.sticky-header');
  var logo = $('.top-header');
    var win = $(window);
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 120){
            header.removeClass('stick');
            logo.removeClass('hidesection');
        } else {
            header.addClass('stick');
      logo.addClass('hidesection');
        }
    });

    /** Sticky Header js **/


    /** Mobile sidebar Menus  js **/
    $('.moble-menus-models').click(function(){
      $('.mobile-menu-side-modals').addClass('open-side');
      $("body").css('overflow-y','hidden');
    });

    $('.side-modals-close').click(function(){
      $('.side-modals').removeClass('open-side');
      $("body").css('overflow-y','');
    })
    /** Mobile sidebar Menus  js **/


    /** Matis Menus  js **/
      $('#menu').metisMenu({

      // enabled/disable the auto collapse.
      toggle: true,

      // prevent default event
      preventDefault: true,

      // default classes
      activeClass: 'active',
      collapseClass: 'collapse',
      collapseInClass: 'in',
      collapsingClass: 'collapsing',

      // .nav-link for Bootstrap 4
      triggerElement: 'span',

      // .nav-item for Bootstrap 4
      parentTrigger: 'li',

      // .nav.flex-column for Bootstrap 4
      subMenu: 'ul'

    });

    /** Matis Menus  js **/

});
