document.addEventListener('DOMContentLoaded', function() {
    const filtros = {
        cidade: 'todas',
        deficiencia: 'todas'
    };

    const cardsSelector = '.ponto-card';
    const sectionSelector = '.cidade-section';

    function toSlug(texto) {
        return (texto || '')
            .toString()
            .normalize('NFD').replace(/\p{Diacritic}/gu, '')
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    function coletarCidades() {
        const cidades = new Map();
        document.querySelectorAll(sectionSelector).forEach(sec => {
            const titulo = sec.querySelector('h2')?.textContent?.trim();
            if (titulo) cidades.set(toSlug(titulo), titulo);
        });
        return Array.from(cidades.entries()).map(([value, label]) => ({ value, label }));
    }

    // Lista base de deficiências; itens serão combinados com os presentes nos cards via data-deficiencias
    function coletarDeficiencias() {
        const base = ['auditiva', 'visual', 'fisica'];
        const doDom = new Set();
        document.querySelectorAll(cardsSelector).forEach(card => {
            const raw = card.getAttribute('data-deficiencias');
            if (!raw) return;
            raw.split(',').map(s => s.trim().toLowerCase()).forEach(v => v && doDom.add(v));
        });
        const setAll = new Set([...base, ...Array.from(doDom)]);
        return Array.from(setAll).sort().map(v => ({ value: v, label: v.charAt(0).toUpperCase() + v.slice(1) }));
    }

    function montarMenu(tipo, itens) {
        const menu = document.querySelector(`[data-menu="${tipo}"]`);
        if (!menu) return;
        menu.innerHTML = '';
        const todosItem = document.createElement('li');
        todosItem.setAttribute('role', 'option');
        todosItem.setAttribute('data-value', 'todas');
        todosItem.textContent = 'Todas';
        menu.appendChild(todosItem);
        itens.forEach(({ value, label }) => {
            const li = document.createElement('li');
            li.setAttribute('role', 'option');
            li.setAttribute('data-value', value);
            li.textContent = label;
            menu.appendChild(li);
        });
    }

    function atualizarDropdownLabel(tipo) {
        const valueSpan = document.querySelector(`[data-value-label="${tipo}"]`);
        if (!valueSpan) return;
        if (filtros[tipo] === 'todas') {
            valueSpan.textContent = 'Todas';
            return;
        }
        if (tipo === 'cidade') {
            const cidades = coletarCidades();
            const found = cidades.find(c => c.value === filtros.cidade);
            valueSpan.textContent = found ? found.label : 'Todas';
        } else {
            valueSpan.textContent = filtros.deficiencia.charAt(0).toUpperCase() + filtros.deficiencia.slice(1);
        }
    }

    function aplicarFiltrosCompactos() {
        const cards = document.querySelectorAll(cardsSelector);
        const secoes = document.querySelectorAll(sectionSelector);

        let visiveis = 0;
        cards.forEach(card => {
            const secao = card.closest(sectionSelector);
            const cidadeTitulo = secao?.querySelector('h2')?.textContent?.trim() || '';
            const cidadeSlug = toSlug(cidadeTitulo);

            const defAttr = (card.getAttribute('data-deficiencias') || '')
                .split(',')
                .map(s => s.trim().toLowerCase())
                .filter(Boolean);

            const passaCidade = filtros.cidade === 'todas' || filtros.cidade === cidadeSlug;
            const passaDef = filtros.deficiencia === 'todas' || (defAttr.length > 0 && defAttr.includes(filtros.deficiencia));

            const mostrar = passaCidade && passaDef;
            card.style.display = mostrar ? '' : 'none';
            if (mostrar) visiveis += 1;
        });

        secoes.forEach(sec => {
            const temVisivel = Array.from(sec.querySelectorAll(cardsSelector)).some(c => c.style.display !== 'none');
            sec.style.display = temVisivel ? '' : 'none';
        });

        const contador = document.querySelector('.contador-resultados');
        if (contador) {
            contador.textContent = `Mostrando ${visiveis} hotéis` +
                (filtros.cidade !== 'todas' ? ` • Cidade: ${document.querySelector(`[data-value-label="cidade"]`)?.textContent || ''}` : '') +
                (filtros.deficiencia !== 'todas' ? ` • Deficiência: ${document.querySelector(`[data-value-label="deficiencia"]`)?.textContent || ''}` : '');
        }
    }

    function initDropdowns() {
        montarMenu('cidade', coletarCidades());
        montarMenu('deficiencia', coletarDeficiencias());
        atualizarDropdownLabel('cidade');
        atualizarDropdownLabel('deficiencia');

        document.querySelectorAll('.dropdown-toggle').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const parent = btn.closest('.dropdown');
                const expanded = parent.classList.toggle('open');
                btn.setAttribute('aria-expanded', String(expanded));
            });
        });

        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown.open').forEach(d => {
                d.classList.remove('open');
                const t = d.querySelector('.dropdown-toggle');
                if (t) t.setAttribute('aria-expanded', 'false');
            });
        });

        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', (e) => {
                const item = e.target.closest('[data-value]');
                if (!item) return;
                const tipo = menu.getAttribute('data-menu');
                const valor = item.getAttribute('data-value');
                filtros[tipo] = valor || 'todas';
                atualizarDropdownLabel(tipo);
                aplicarFiltrosCompactos();
            });
        });

        aplicarFiltrosCompactos();
    }

    // Injetar estilos mínimos para os filtros compactos
    const filtrosCss = `
    .filtros-compactos { padding-block: 20px; background: var(--cultured); }
    .filtros-compactos .filtros-bar { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
    .filtros-compactos .dropdown { position: relative; }
    .filtros-compactos .dropdown-toggle { display: flex; align-items: center; gap: 8px; padding: 10px 14px; border: 1px solid var(--gainsboro); border-radius: 10px; background: #fff; color: var(--oxford-blue); }
    .filtros-compactos .dropdown-value { font-weight: 600; }
    .filtros-compactos .dropdown-menu { position: absolute; top: calc(100% + 6px); left: 0; background: #fff; border: 1px solid var(--gainsboro); border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); min-width: 220px; max-height: 260px; overflow: auto; padding: 6px; display: none; z-index: 30; }
    .filtros-compactos .dropdown.open .dropdown-menu { display: block; }
    .filtros-compactos .dropdown-menu li { padding: 10px 10px; border-radius: 8px; cursor: pointer; }
    .filtros-compactos .dropdown-menu li:hover { background: var(--cultured); }
    `;
    const style = document.createElement('style');
    style.textContent = filtrosCss;
    document.head.appendChild(style);

    // Inicializa filtros compactos
    initDropdowns();
});

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

const styleSheet = document.createElement('style');
styleSheet.textContent = estilosAdicionais;
document.head.appendChild(styleSheet);

document.addEventListener('DOMContentLoaded', function() {
    function initCarousel(container) {
        const wrapper = container.querySelector('.carousel-wrapper');
        const list = container.querySelector('.carousel-list');
        const items = list ? list.querySelectorAll('.carousel-item') : [];
        const prevBtn = container.querySelector('.prev-btn');
        const nextBtn = container.querySelector('.next-btn');

        if (!wrapper || !list || !items.length || !prevBtn || !nextBtn) return;

        let dotsContainer = null;
        if (list.id) {
            const guessedDotsId = list.id.replace('Carousel', 'Dots');
            dotsContainer = document.getElementById(guessedDotsId);
        }

        function getPageMetrics() {
            const pageWidth = wrapper.clientWidth;
            const totalWidth = list.scrollWidth;
            const totalPages = Math.max(1, Math.ceil(totalWidth / pageWidth));
            return { pageWidth, totalWidth, totalPages };
        }

        let currentPage = 0;

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

        nextBtn.addEventListener('click', (e) => { if (!nextBtn.classList.contains('disabled')) nextPage(); });
        prevBtn.addEventListener('click', (e) => { if (!prevBtn.classList.contains('disabled')) prevPage(); });
        wrapper.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', () => { buildDots(); updateButtons(); goToPage(currentPage); });

        buildDots();
        updateButtons();
        goToPage(0);
    }

    document.querySelectorAll('.carousel-container').forEach(initCarousel);
});