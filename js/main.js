$(document).ready(function () {
  new Swiper(".hotel-slider", {
    loop: !0,
    navigation: {
      nextEl: ".hotel-slider__button--next",
      prevEl: ".hotel-slider__button--prev"
    },
    keyboard: !0,
    autoplay: {
      delay: 5e3
    },
    speed: 500
  }), new Swiper(".reviews-slider", {
    loop: !0,
    navigation: {
      nextEl: ".reviews-slider__button--next",
      prevEl: ".reviews-slider__button--prev"
    },
    keyboard: !0,
    speed: 300
  });
  $(".parallax-window").parallax({
    imageSrc: "img/newsletter-bg.jpg"
  }), $(".menu-button").on("click", function () {
    $(".navbar-bottom").toggleClass("navbar-bottom--visible")
  });
  var e = $("[data-toggle=modal]"),
    a = $(".modal__close");

  function o(e) {
    e.preventDefault();
    var a = $(".modal__overlay"),
      o = $(".modal__dialog");
    a.removeClass("modal__overlay--visible"), o.removeClass("modal__dialog--visible")
  }
  e.on("click", function () {
    var e = $(".modal__overlay"),
      a = $(".modal__dialog");
    e.addClass("modal__overlay--visible"), a.addClass("modal__dialog--visible")
  }), a.on("click", o), $(document).on("keydown", function (e) {
    27 == e.keyCode && o(e)
  }), $(".map").click(function () {
    var e = $(this).attr("data-map");
    $(this).html('<iframe src="' + e + '" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>')
  }), $(".form").each(function () {
    $(this).validate({
      rules: {
        name: {
          required: !0,
          minlength: 2
        },
        phone: {
          required: !0,
          minlength: 16
        },
        email: {
          required: !0,
          email: !0
        }
      },
      messages: {
        name: {
          required: "Please introduce yourself!",
          minlength: jQuery.validator.format("At least {0} characters required!")
        },
        email: {
          required: "We need your email address to contact you",
          email: "Your email address must be in the format of name@domain.com"
        },
        phone: {
          required: "We need your phone number to contact you",
          minlength: jQuery.validator.format("The number must contain 11 digits")
        }
      },
      errorClass: "invalid"
    })
  }), $(".phone").mask("+7(000)000-00-00"), $(function () {
    992 < $(window).width() && AOS.init()
  })
});