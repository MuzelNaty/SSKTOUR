// Funcionalidade de filtros para a página de destinos

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const filtroBtns = document.querySelectorAll('.filtro-btn');
    const filtroCidadeBtns = document.querySelectorAll('.filtro-cidade-btn');
    const pontoCards = document.querySelectorAll('.ponto-card');
    
    // Estado dos filtros
    let filtroCidadeAtivo = 'todas';
    let filtroTipoAtivo = 'todos';
    
    // Mapeamento de tipos para filtros
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
    
    // Mapeamento de cidades para filtros
    const cidadeMapping = {
        'barretos': ['barretos'],
        'campos-do-jordao': ['campos-do-jordao'],
        'guaruja': ['guaruja'],
        'ilhabela': ['ilhabela'],
        'olimpia': ['olimpia'],
        'sao-paulo': ['sao-paulo'],
        'ubatuba': ['ubatuba']
    };
    
    // Função para aplicar filtros combinados
    function aplicarFiltros() {
        const cidadeSections = document.querySelectorAll('.cidade-section');
        
        // Primeiro, processar todos os cards
        pontoCards.forEach(card => {
            const tipoPonto = card.getAttribute('data-tipo');
            const cidadePonto = card.closest('.cidade-section').id;
            
            let mostrarPorCidade = true;
            let mostrarPorTipo = true;
            
            // Verificar filtro de cidade
            if (filtroCidadeAtivo !== 'todas') {
                mostrarPorCidade = cidadeMapping[filtroCidadeAtivo] && 
                                 cidadeMapping[filtroCidadeAtivo].includes(cidadePonto);
            }
            
            // Verificar filtro de tipo
            if (filtroTipoAtivo !== 'todos') {
                mostrarPorTipo = tipoMapping[filtroTipoAtivo] && 
                               tipoMapping[filtroTipoAtivo].includes(tipoPonto);
            }
            
            // Mostrar card apenas se passar em ambos os filtros
            if (mostrarPorCidade && mostrarPorTipo) {
                card.classList.remove('hidden');
                card.classList.add('visible');
            } else {
                card.classList.add('hidden');
                card.classList.remove('visible');
            }
        });
        
        // Depois, verificar se cada seção de cidade tem cards visíveis
        cidadeSections.forEach(section => {
            const cardsNaSecao = section.querySelectorAll('.ponto-card');
            const cardsVisiveisNaSecao = section.querySelectorAll('.ponto-card:not(.hidden)');
            
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
        const cardsVisiveis = document.querySelectorAll('.ponto-card:not(.hidden)');
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
        let textoContador = `Mostrando ${cardsVisiveis.length} pontos turísticos`;
        
        // Adicionar informações sobre os filtros ativos
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
    
    // Event listeners para os botões de filtro por tipo
    filtroBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover classe active de todos os botões de tipo
            filtroBtns.forEach(b => b.classList.remove('active'));
            
            // Adicionar classe active ao botão clicado
            this.classList.add('active');
            
            // Atualizar filtro de tipo ativo
            filtroTipoAtivo = this.getAttribute('data-filtro');
            
            // Aplicar filtros
            aplicarFiltros();
        });
    });
    
    // Adicionar funcionalidade de navegação para páginas individuais
    pontoCards.forEach(card => {
        card.addEventListener('click', function() {
            const nome = this.querySelector('h3').textContent;
            const tipo = this.getAttribute('data-tipo');
            const cidade = this.closest('.cidade-section').id;
            
            // Criar URL amigável para o ponto turístico
            const urlAmigavel = nome.toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            
            // Navegar para a página do ponto turístico
            window.location.href = `./pontos-turisticos/${urlAmigavel}.html`;
        });
        
        // Adicionar cursor pointer e indicador visual de que é clicável
        card.style.cursor = 'pointer';
        card.title = 'Clique para mais detalhes';
    });
    
    // Inicializar com todos os filtros visíveis
    aplicarFiltros();
    
    // Adicionar animação de entrada para os cards
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
    
    // Executar animação após um pequeno delay
    setTimeout(animarCardsEntrada, 300);
});

// Adicionar estilos CSS dinâmicos para funcionalidades extras
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

// Injetar estilos adicionais
const styleSheet = document.createElement('style');
styleSheet.textContent = estilosAdicionais;
document.head.appendChild(styleSheet);
