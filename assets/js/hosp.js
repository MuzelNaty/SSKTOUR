// Funcionalidade de filtros para a página de hospedagem

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const filtroCidadeBtns = document.querySelectorAll('.filtro-cidade-btn');
    const hotelCards = document.querySelectorAll('.carousel-item');
    
    // Estado dos filtros
    let filtroCidadeAtivo = 'todas';
    
    // Mapeamento de cidades para filtros
    const cidadeMapping = {
        'sao-paulo': ['sao-paulo'],
        'ubatuba': ['ubatuba'],
        'campos-do-jordao': ['campos-do-jordao'],
        'santos': ['santos']
    };
    
    // Função para aplicar filtros
    function aplicarFiltros() {
        const cidadeSections = document.querySelectorAll('.cidade-section');
        
        // Primeiro, processar todos os cards de hotéis
        hotelCards.forEach(card => {
            const cidadeHotel = card.closest('.cidade-section').id;
            
            let mostrarPorCidade = true;
            
            // Verificar filtro de cidade
            if (filtroCidadeAtivo !== 'todas') {
                mostrarPorCidade = cidadeMapping[filtroCidadeAtivo] && 
                                 cidadeMapping[filtroCidadeAtivo].includes(cidadeHotel);
            }
            
            // Mostrar card apenas se passar no filtro
            if (mostrarPorCidade) {
                card.classList.remove('hidden');
                card.classList.add('visible');
            } else {
                card.classList.add('hidden');
                card.classList.remove('visible');
            }
        });
        
        // Depois, verificar se cada seção de cidade tem cards visíveis
        cidadeSections.forEach(section => {
            const cardsNaSecao = section.querySelectorAll('.carousel-item');
            const cardsVisiveisNaSecao = section.querySelectorAll('.carousel-item:not(.hidden)');
            
            // Se não há cards visíveis na seção, ocultar toda a seção
            if (cardsVisiveisNaSecao.length === 0) {
                section.style.opacity = '0';
                section.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    section.style.display = 'none';
                }, 300);
            } else {
                section.style.display = 'block';
                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, 50);
            }
        });
        
        // Atualizar contador de resultados
        atualizarContadorResultados();
    }
    
    // Função para atualizar contador de resultados
    function atualizarContadorResultados() {
        const cardsVisiveis = document.querySelectorAll('.carousel-item:not(.hidden)');
        const contadorElement = document.querySelector('.contador-resultados');
        
        if (!contadorElement) {
            // Criar elemento de contador se não existir
            const filtrosWrapper = document.querySelector('.filtros-wrapper');
            const contador = document.createElement('p');
            contador.className = 'contador-resultados';
            contador.style.marginTop = '20px';
            contador.style.color = '#666';
            filtrosWrapper.appendChild(contador);
        }
        
        const contador = document.querySelector('.contador-resultados');
        let textoContador = `Mostrando ${cardsVisiveis.length} hotéis`;
        
        // Adicionar informações sobre os filtros ativos
        if (filtroCidadeAtivo !== 'todas') {
            const cidadeNome = document.querySelector(`[data-cidade="${filtroCidadeAtivo}"]`).textContent;
            textoContador += ` (${cidadeNome})`;
        }
        
        contador.textContent = textoContador;
    }
    
    // Event listeners para os botões de filtro por cidade
    filtroCidadeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover classe active de todos os botões de cidade
            filtroCidadeBtns.forEach(b => b.classList.remove('active'));
            
            // Adicionar classe active ao botão clicado
            this.classList.add('active');
            
            // Atualizar filtro de cidade ativo
            filtroCidadeAtivo = this.getAttribute('data-cidade');
            
            // Aplicar filtros
            aplicarFiltros();
        });
    });
    
    // Inicializar com todos os filtros visíveis
    aplicarFiltros();
    
    // Adicionar animação de entrada para os cards
    function animarCardsEntrada() {
        hotelCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }, index * 50);
        });
    }
    
    // Executar animação após um pequeno delay
    setTimeout(animarCardsEntrada, 300);
});

// Adicionar estilos CSS dinâmicos para funcionalidades extras
const estilosAdicionais = `
    .carousel-item {
        position: relative;
        overflow: hidden;
    }
    
    .contador-resultados {
        font-style: italic;
        margin-top: 20px;
    }
    
    .carousel-item.hidden {
        display: none;
    }
    
    .carousel-item.visible {
        display: block;
        animation: fadeIn 0.5s ease;
    }
    
    .cidade-section {
        transition: all 0.5s ease;
    }
    
    .cidade-section[style*="display: none"] {
        opacity: 0;
        transform: translateY(-20px);
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;

// Injetar estilos adicionais
const styleSheet = document.createElement('style');
styleSheet.textContent = estilosAdicionais;
document.head.appendChild(styleSheet);

// Inicialização de carrosséis (Campos do Jordão, São Paulo, Santos, Ubatuba)
document.addEventListener('DOMContentLoaded', function() {
    function initCarousel(container) {
        const wrapper = container.querySelector('.carousel-wrapper');
        const list = container.querySelector('.carousel-list');
        const items = list ? list.querySelectorAll('.carousel-item') : [];
        const prevBtn = container.querySelector('.prev-btn');
        const nextBtn = container.querySelector('.next-btn');

        if (!wrapper || !list || !items.length || !prevBtn || !nextBtn) return;

        // Descobrir container de dots pelo id do UL (ex: stCarousel -> stDots)
        let dotsContainer = null;
        if (list.id) {
            const guessedDotsId = list.id.replace('Carousel', 'Dots');
            dotsContainer = document.getElementById(guessedDotsId);
        }

        // Helpers de página
        function getPageMetrics() {
            const pageWidth = wrapper.clientWidth;
            const totalWidth = list.scrollWidth;
            const totalPages = Math.max(1, Math.ceil(totalWidth / pageWidth));
            return { pageWidth, totalWidth, totalPages };
        }

        // Estado
        let currentPage = 0;

        // Criar/atualizar dots dinamicamente
        function buildDots() {
            if (!dotsContainer) return;
            const { totalPages } = getPageMetrics();
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalPages; i++) {
                const dot = document.createElement('button');
                dot.className = 'dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('data-slide', String(i));
                dot.addEventListener('click', () => goToPage(i));
                dotsContainer.appendChild(dot);
            }
        }

        function updateButtons() {
            const { totalPages } = getPageMetrics();
            prevBtn.classList.toggle('disabled', currentPage <= 0);
            nextBtn.classList.toggle('disabled', currentPage >= totalPages - 1);
        }

        function updateDots() {
            if (!dotsContainer) return;
            const dots = dotsContainer.querySelectorAll('.dot');
            dots.forEach((dot, idx) => dot.classList.toggle('active', idx === currentPage));
        }

        function goToPage(pageIndex) {
            const { pageWidth, totalPages } = getPageMetrics();
            currentPage = Math.max(0, Math.min(pageIndex, totalPages - 1));
            wrapper.scrollTo({ left: currentPage * pageWidth, behavior: 'smooth' });
            updateButtons();
            updateDots();
        }

        function nextPage() { goToPage(currentPage + 1); }
        function prevPage() { goToPage(currentPage - 1); }

        // Sync ao rolar manualmente (ex.: touch)
        let rafId = null;
        function onScroll() {
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(() => {
                const { pageWidth, totalPages } = getPageMetrics();
                const approxPage = Math.round(wrapper.scrollLeft / Math.max(1, pageWidth));
                const clamped = Math.max(0, Math.min(approxPage, totalPages - 1));
                if (clamped !== currentPage) {
                    currentPage = clamped;
                    updateButtons();
                    updateDots();
                }
            });
        }

        // Eventos
        nextBtn.addEventListener('click', (e) => { if (!nextBtn.classList.contains('disabled')) nextPage(); });
        prevBtn.addEventListener('click', (e) => { if (!prevBtn.classList.contains('disabled')) prevPage(); });
        wrapper.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', () => { buildDots(); updateButtons(); goToPage(currentPage); });

        // Init
        buildDots();
        updateButtons();
        goToPage(0);
    }

    // Inicializar todos os carrosséis presentes na página
    document.querySelectorAll('.carousel-container').forEach(initCarousel);
});