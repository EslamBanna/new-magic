$('.owl-carousel').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    navText: [
      "",
      ""
    ],
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 4
      },
      600: {
        items: 4
      },
      1000: {
        items: 7
      }
    }
  })