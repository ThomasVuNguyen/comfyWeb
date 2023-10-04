(function ($) {
  "use strict";

  $.fn.portfolioViewAccessibleDropDown = function () {
    var el = $(this);
    $("a", el)
      .focus(function () {
        $(this).parents("li").addClass("hover");
      })
      .blur(function () {
        $(this).parents("li").removeClass("hover");
      });
  };

  //document ready function
  jQuery(document).ready(function ($) {
    $("#portfolio-view-menu").portfolioViewAccessibleDropDown();

    $("#besearch").on("click", function (e) {
      e.preventDefault();
      $("#bspopup").addClass("popup-box-on");
    });

    $("#sremoveClass").click(function () {
      $("#bspopup").removeClass("popup-box-on");
    });
    $('#sremoveClass').keydown(function(e) {
      $('#bspopup').removeClass("popup-box-on");
  });
  }); // end document ready



   function stickyElement(e) {
   
    var banner = document.querySelector(".home-intro");
    if(banner){
      var bannerHeight = getComputedStyle(banner).height.split("px")[0];
    }else{
      var bannerHeight = ' ';
    }

     var header = document.querySelector("header#header + div");
    if(header){
    var headerHeight = getComputedStyle(header).height.split("px")[0];
    }else{
      var headerHeight = ' ';
    }

    
    var menuBar = document.querySelector(".menu-bar");
    var scrollValue = window.scrollY;
    if(menuBar){
      if (scrollValue > headerHeight || scrollValue > bannerHeight) {
            menuBar.classList.add("is-fixed");
          } else if (scrollValue < headerHeight || scrollValue < bannerHeight) {
            menuBar.classList.remove("is-fixed");
          }
    }
    
  }


  window.addEventListener("scroll", stickyElement);
  document.body.classList.add('jsloaded');
})(jQuery);
