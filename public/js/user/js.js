$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 40,
    nav: true,
    navText: [
      "",
      ""
    ],
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 6
      }
    }
  })