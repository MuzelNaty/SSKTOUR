/* script do carrossel hotéis */
document.addEventListener('DOMContentLoaded', function () {
      const carousel = document.getElementById('hotelCarousel');
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      const dotsContainer = document.getElementById('carouselDots');

      if (!carousel || !prevBtn || !nextBtn || !dotsContainer) {
        console.error('Elementos do carrossel não encontrados');
        return;
      }

      let currentIndex = 0;
      const items = carousel.querySelectorAll('.carousel-item');
      const totalItems = items.length;

      if (totalItems === 0) {
        console.error('Nenhum item encontrado no carrossel');
        return;
      }

      // Criar indicadores
      for (let i = 0; i < totalItems; i++) {
        const dot = document.createElement('button');
        dot.className = 'dot';
        dot.setAttribute('aria-label', `Ir para foto ${i + 1}`);
        dot.addEventListener('click', () => goToSlide(i));
        dotsContainer.appendChild(dot);
      }

      const dots = dotsContainer.querySelectorAll('.dot');

      function updateCarousel() {
        const offset = -currentIndex * 16.888;
        carousel.style.transform = `translateX(${offset}%)`;

        // Atualizar indicadores
        dots.forEach((dot, index) => {
          dot.classList.toggle('active', index === currentIndex);
        });

        // Atualizar botões
        prevBtn.classList.toggle('disabled', currentIndex === 0);
        nextBtn.classList.toggle('disabled', currentIndex === totalItems - 1);
      }

      function goToSlide(index) {
        currentIndex = index;
        updateCarousel();
      }

      function nextSlide() {
        if (currentIndex < totalItems - 1) {
          currentIndex++;
          updateCarousel();
        }
      }

      function prevSlide() {
        if (currentIndex > 0) {
          currentIndex--;
          updateCarousel();
        }
      }

      // Event listeners
      nextBtn.addEventListener('click', nextSlide);
      prevBtn.addEventListener('click', prevSlide);

      // Navegação por teclado
      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
          prevSlide();
        } else if (e.key === 'ArrowRight') {
          nextSlide();
        }
      });

      // Removido auto-play - as fotos só mudam quando clicar nas setas

      // Inicializar
      updateCarousel();
    });