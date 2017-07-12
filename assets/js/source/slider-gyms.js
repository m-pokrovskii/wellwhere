$('.SliderGyms').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: true,
  appendArrows: $('.SliderContainer'),
  nextArrow: '<img class="SliderGyms__nextArrow" src="'+data.url+'/assets/img/arrow.svg" alt="">',
  prevArrow: '<img class="SliderGyms__prevArrow" src=".'+data.url+'/assets/img/arrow.svg" alt="">',
  responsive: [
      {
        breakpoint: 1025,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 2
        }
      },
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      },
  ]
})
