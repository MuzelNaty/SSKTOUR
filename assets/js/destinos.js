document.addEventListener('DOMContentLoaded', function() {
    const filtroBtns = document.querySelectorAll('.filtro-btn');
    const filtroCidadeBtns = document.querySelectorAll('.filtro-cidade-btn');
    const pontoCards = document.querySelectorAll('.ponto-card');
    
    let filtroCidadeAtivo = 'todas';
    let filtroTipoAtivo = 'todos';
    
    const tipoMapping = {
        'praia': ['praia'],
        'parque-aquatico': ['parque-aquatico'],
        'museu': ['museu'],
        'parque': ['parque'],
        'cachoeira': ['cachoeira'],
        'cultura': ['cultura'],
        'religioso': ['religioso'],
        'diversao': ['diversao']
    };
    
    const cidadeMapping = {
        'barretos': ['barretos'],
        'campos-do-jordao': ['campos-do-jordao'],
        'guaruja': ['guaruja'],
        'ilhabela': ['ilhabela'],
        'olimpia': ['olimpia'],
        'sao-paulo': ['sao-paulo'],
        'ubatuba': ['ubatuba']
    };
    
    function aplicarFiltros() {
        const cidadeSections = document.querySelectorAll('.cidade-section');
        
        pontoCards.forEach(card => {
            const tipoPonto = card.getAttribute('data-tipo');
            const cidadePonto = card.closest('.cidade-section').id;
            
            let mostrarPorCidade = true;
            let mostrarPorTipo = true;
            
            if (filtroCidadeAtivo !== 'todas') {
                mostrarPorCidade = cidadeMapping[filtroCidadeAtivo] && 
                                 cidadeMapping[filtroCidadeAtivo].includes(cidadePonto);
            }
            
            if (filtroTipoAtivo !== 'todos') {
                mostrarPorTipo = tipoMapping[filtroTipoAtivo] && 
                               tipoMapping[filtroTipoAtivo].includes(tipoPonto);
            }
            
            if (mostrarPorCidade && mostrarPorTipo) {
                card.classList.remove('hidden');
                card.classList.add('visible');
            } else {
                card.classList.add('hidden');
                card.classList.remove('visible');
            }
        });
        
        cidadeSections.forEach(section => {
            const cardsNaSecao = section.querySelectorAll('.ponto-card');
            const cardsVisiveisNaSecao = section.querySelectorAll('.ponto-card:not(.hidden)');
            
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
        
        atualizarContadorResultados();
    }
    
    function atualizarContadorResultados() {
        const cardsVisiveis = document.querySelectorAll('.ponto-card:not(.hidden)');
        const contadorElement = document.querySelector('.contador-resultados');
        
        if (!contadorElement) {
            const filtrosWrapper = document.querySelector('.filtros-wrapper');
            const contador = document.createElement('p');
            contador.className = 'contador-resultados';
            contador.style.marginTop = '20px';
            contador.style.color = '#666';
            filtrosWrapper.appendChild(contador);
        }
        
        const contador = document.querySelector('.contador-resultados');
        let textoContador = `Mostrando ${cardsVisiveis.length} pontos turísticos`;
        
        if (filtroCidadeAtivo !== 'todas' || filtroTipoAtivo !== 'todos') {
            const filtrosAtivos = [];
            
            if (filtroCidadeAtivo !== 'todas') {
                const cidadeNome = document.querySelector(`[data-cidade="${filtroCidadeAtivo}"]`).textContent;
                filtrosAtivos.push(cidadeNome);
            }
            
            if (filtroTipoAtivo !== 'todos') {
                const tipoNome = document.querySelector(`[data-filtro="${filtroTipoAtivo}"]`).textContent;
                filtrosAtivos.push(tipoNome);
            }
            
            textoContador += ` (${filtrosAtivos.join(' + ')})`;
        }
        
        contador.textContent = textoContador;
    }
    
    filtroCidadeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filtroCidadeBtns.forEach(b => b.classList.remove('active'));
            
            this.classList.add('active');
            
            filtroCidadeAtivo = this.getAttribute('data-cidade');
            
            aplicarFiltros();
        });
    });
    
    filtroBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filtroBtns.forEach(b => b.classList.remove('active'));
            
            this.classList.add('active');
            
            filtroTipoAtivo = this.getAttribute('data-filtro');
            
            aplicarFiltros();
        });
    });
    
    pontoCards.forEach(card => {
        card.addEventListener('click', function() {
            const nome = this.querySelector('h3').textContent;
            const tipo = this.getAttribute('data-tipo');
            const cidade = this.closest('.cidade-section').id;
            
            const urlAmigavel = nome.toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            
            window.location.href = `./pontos-turisticos/${urlAmigavel}.html`;
        });
        
        card.style.cursor = 'pointer';
        card.title = 'Clique para mais detalhes';
    });
    
    aplicarFiltros();
    
    function animarCardsEntrada() {
        pontoCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }, index * 100);
        });
    }
    
    setTimeout(animarCardsEntrada, 300);
});

const estilosAdicionais = `
    .ponto-card {
        position: relative;
        overflow: hidden;
    }
    
    .contador-resultados {
        font-style: italic;
        margin-top: 20px;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = estilosAdicionais;
document.head.appendChild(styleSheet);