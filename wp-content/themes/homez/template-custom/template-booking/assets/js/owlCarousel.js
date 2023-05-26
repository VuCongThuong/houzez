$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    navText: [
      '<span class="owl-nav-prev"><i class="fa-solid fa-arrow-left"></i> </span>',
      '<span class="owl-nav-next"><i class="fa-solid fa-arrow-right"></i></span>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 6,
      },
    },
  });
});
