//Custom Js File
(function ($) {
  //smooth scroll for links with class of smooth
  var $root = $("html, body");
  $("li.smooth a").click(function () {
    var href = $.attr(this, "href");
    $root.animate(
      {
        scrollTop: $(href).offset().top
      },
      500,
      function () {
        window.location.hash = href;
      }
    );
    return false;
  });

  $("a.smooth").click(function () {
    var href = $.attr(this, "href");
    $root.animate(
      {
        scrollTop: $(href).offset().top
      },
      500,
      function () {
        window.location.hash = href;
      }
    );
    return false;
  });


  // Scroll to Top Button
  var btn = $("#scroll-to-top");
  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });



})(jQuery);