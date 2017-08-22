$('.SmOpener').on('click', toggleMobileMenu);

function toggleMobileMenu(e) {
  $('.SmOpener').toggleClass('open')
  $('.SmMenu').slideToggle();
}
