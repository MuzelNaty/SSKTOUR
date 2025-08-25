"use strict";
const overlay = document.querySelector("[data-overlay]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navbar = document.querySelector("[data-navbar]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");
const navLinks = document.querySelectorAll("[data-nav-link]");

const navElemArr = [navOpenBtn, navCloseBtn, overlay];

const navToggleEvent = function (elem) {
  for (let i = 0; i < elem.length; i++) {
    elem[i].addEventListener("click", function () {
      navbar.classList.toggle("active");
      overlay.classList.toggle("active");
    });
  }
};

navToggleEvent(navElemArr);
navToggleEvent(navLinks);

const header = document.querySelector("[data-header]");
const goTopBtn = document.querySelector("[data-go-top]");

window.addEventListener("scroll", function () {
  if (window.scrollY >= 200) {
    header.classList.add("active");
    goTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    goTopBtn.classList.remove("active");
  }
});

document.addEventListener('DOMContentLoaded', function () {
  function createCarousel(carouselId, dotsId) {
    const carousel = document.getElementById(carouselId);
    const dots = document.querySelectorAll(`#${dotsId} .dot`);
    const container = carousel.closest('.carousel-container');
    const prevBtn = container.querySelector('.prev-btn');
    const nextBtn = container.querySelector('.next-btn');

    if (!carousel) return null;

    let currentSlide = 0;
    const totalSlides = carousel.children.length;
    let slidesPerView = getSlidesPerView();

    function getSlidesPerView() {
      if (window.innerWidth <= 767) return 1;
      if (window.innerWidth <= 1023) return 2;
      return 3;
    }

    function updateCarousel() {
      const slideWidth = 100 / slidesPerView;
      const translateX = -(currentSlide * slideWidth);
      carousel.style.transform = `translateX(${translateX}%)`;

      dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
      });

      if (prevBtn) {
        prevBtn.disabled = currentSlide === 0;
        prevBtn.classList.toggle('disabled', currentSlide === 0);
      }

      if (nextBtn) {
        nextBtn.disabled = currentSlide >= totalSlides - slidesPerView;
        nextBtn.classList.toggle('disabled', currentSlide >= totalSlides - slidesPerView);
      }
    }

    function nextSlide() {
      if (currentSlide < totalSlides - slidesPerView) {
        currentSlide++;
        updateCarousel();
      }
    }

    function prevSlide() {
      if (currentSlide > 0) {
        currentSlide--;
        updateCarousel();
      }
    }

    function goToSlide(slideIndex) {
      currentSlide = slideIndex;
      updateCarousel();
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', nextSlide);
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', prevSlide);
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => goToSlide(index));
    });

    let startX = 0;
    let endX = 0;

    carousel.addEventListener('touchstart', function (e) {
      startX = e.touches[0].clientX;
    });

    carousel.addEventListener('touchend', function (e) {
      endX = e.changedTouches[0].clientX;
      handleSwipe();
    });

    function handleSwipe() {
      const swipeThreshold = 50;
      const diff = startX - endX;

      if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
          nextSlide();
        } else {
          prevSlide();
        }
      }
    }

    function handleResize() {
      const newSlidesPerView = getSlidesPerView();
      if (newSlidesPerView !== slidesPerView) {
        slidesPerView = newSlidesPerView;
        currentSlide = 0;
        updateCarousel();
      }
    }

    window.addEventListener('resize', handleResize);

    updateCarousel();

    return {
      nextSlide,
      prevSlide,
      goToSlide,
      updateCarousel
    };
  }

  const carousels = [
    { carouselId: 'spCarousel', dotsId: 'spDots' },
    { carouselId: 'ubtbCarousel', dotsId: 'ubtbDots' },
    { carouselId: 'cjCarousel', dotsId: 'cjDots' }
  ];

  const carouselInstances = {};

  carousels.forEach(({ carouselId, dotsId }) => {
    const instance = createCarousel(carouselId, dotsId);
    if (instance) {
      carouselInstances[carouselId] = instance;
    }
  });

  document.addEventListener('keydown', function (e) {
    const activeElement = document.activeElement;
    const isInCarousel = activeElement.closest('.carousel-container');

    if (isInCarousel) {
      const carouselContainer = activeElement.closest('.carousel-container');
      const carouselList = carouselContainer.querySelector('.carousel-list');
      const carouselId = carouselList.id;

      if (carouselInstances[carouselId]) {
        if (e.key === 'ArrowLeft') {
          carouselInstances[carouselId].prevSlide();
        } else if (e.key === 'ArrowRight') {
          carouselInstances[carouselId].nextSlide();
        }
      }
    }
  });

  document.querySelectorAll('.clickable-card').forEach(card => {
    card.addEventListener('click', function (e) {
      e.stopPropagation();

      console.log('Hotel clicado:', this.querySelector('.card-title').textContent);

    });
  });
});
