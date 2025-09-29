const swiper = new Swiper('.swiper',{

    effect: 'slide',
    speed: 1000,
    loop: true,
    autoplay: {
      delay: 9000,
      disableOnInteraction: false,
    },
})
ScrollReveal().reveal('.principal-descubre', {
    distance: '50px',
    duration: 800,
    easing: 'ease-in-out',
    origin: 'bottom'
  });

ScrollReveal().reveal('.principal-descuentos', {
    distance: '50px',
    duration: 800,
    easing: 'ease-in-out',
    origin: 'bottom'
  });
