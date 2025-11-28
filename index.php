<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="shortcut icon" href="./assets/imagens/icon.png" type="image/svg+xml">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
        <style>
    /* SELECT estilizado como o antigo .input-field */
.tour-search-form select {
  width: 100%;
  background: var(--white);
  padding: 10px 15px;
  font-size: var(--fs-5);
  border-radius: 50px;
  border: none;
  appearance: none;        /* remove seta padrão */
  -webkit-appearance: none;
  -moz-appearance: none;
  cursor: pointer;
}

/* seta personalizada */
.tour-search-form .input-wrapper {
  position: relative;
}

.tour-search-form .input-wrapper::after {
  content: "▾";  /* seta */
  position: absolute;
  right: 20px;
  top: 55%;
  transform: translateY(-50%);
  font-size: 18px;
  pointer-events: none;
}

/* label igual ao antigo */
.tour-search-form .input-label {
  color: var(--white);
  font-size: var(--fs-4);
  margin-left: 20px;
  margin-bottom: 10px;
}

/* manter margens */
.tour-search-form .input-wrapper {
  margin-bottom: 15px;
}

/* Versão responsiva (você tinha isso também no CSS antigo) */
@media (min-width: 768px) {
  .tour-search-form .input-wrapper {
    margin-bottom: 0;
  }
  .tour-search-form select {
    padding: 16px 20px;
  }
}

/* Centraliza a section inteira */
.tour-search {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 0;
}

/* Centraliza o conteúdo interno */
.tour-search .container {
  display: flex;
  justify-content: center;
}

/* Deixa inputs e botão lado a lado sem esmagar */
.tour-search-form {
  display: flex;
  align-items: flex-end; /* alinha selects + botão na mesma base */
  gap: 20px;
}

/* Ajuste: select não ocupa 100% no desktop */
.tour-search-form .input-wrapper {
  width: auto; /* impede stretch */
}

/* Mantém estilo antigo */
.tour-search-form select {
  width: 220px;  /* tamanho ideal, pode ajustar */
}

/* Responsivo: volta para 100% no celular */
@media (max-width: 600px) {
  .tour-search-form {
    flex-direction: column;
    align-items: stretch;
  }

  .tour-search-form .input-wrapper {
    width: 100%;
  }

  .tour-search-form select {
    width: 100%;
  }
}



  </style>
</head>

<body id="top">
    <!-- header -->
    <header class="header" data-header>
        <div class="overlay" data-overlay></div>
        <div class="header-top">
            <div class="container" style="padding-top: 10px;">
                <a href="#" class="logo">
                    <img src="./assets/imagens/logoBranco.png" alt="SSKTour logo">
                </a>
                <div class="header-btn-group">
                    <button class="nav-open-btn" aria-label="Abrir Menu" data-nav-open-btn>
                        <ion-icon name="menu-outline"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar" data-navbar>
                    <div class="navbar-top">
                        <a href="#" class="logo">
                            <img src="./assets/imagens/logoAzul.png" alt="SSKTour logo">
                        </a>
                        <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </div>
                    <ul class="navbar-list">
                        <li>
                            <a href="index.php" class="navbar-link" data-nav-link>Início</a>
                        </li>
                        <li>
                            <a href="hosp.html" class="navbar-link" data-nav-link>Hospedagem</a>
                        </li>
                        <li>
                            <a href="destinos.html" class="navbar-link" data-nav-link>Destinos</a>
                        </li>
                        <li>
                            <a href="galeria.html" class="navbar-link" data-nav-link>Galeria</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <article>
            <!-- hero -->
            <section class="hero" id="home">
                <div class="container">
                    <h2 class="h1 hero-title">Turismo sem barreiras</h2>
                    <p class="hero-text">
                        Acessibilidade que transforma viagens em experiência para todos.
                    </p>
                </div>
            </section>

            <!-- formulário -->
            <section class="tour-search">
                <div class="container">
                    <form action="pesquisa.php" method="get" class="tour-search-form">
                        <div class="input-wrapper">
                            <label for="cidade" class="input-label">Cidade</label>
                            <select name="cidade" id="">
                                <?php 
                                $acaoc = 'recuperar';
                                require_once 'cidade.controller.php';
                                foreach($cidade as $key => $cidade){ ?>
                                <option value="<?= $cidade->nome?>"> <?= $cidade->nome?></option>
                                <?php } ?>
                            </select>
                            
                           <!-- <input type="text" name="cidade" id="cidade"  placeholder="Cidade" class="input-field">-->
                        </div>
                        <div class="input-wrapper">
                            <label for="deficiencia" class="input-label">Deficiência</label>
                            <select name="deficiencia" id="">
                                <?php 
                                $acaod = 'recuperar';
                                require_once 'def.controller.php';
                                foreach($def as $key => $def){?>
                                <option value="<?= $def->tipo?>"> <?= $def->tipo?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Pesquisar</button>
                    </form>
                </div>
            </section>

            <!-- hotel -->
            <section class="package" id="package">
                <div class="container">
                    <p class="section-subtitle">Hotéis Disponíveis</p>
                    <h2 class="h2 section-title">Encontre a melhor hospedagem</h2>
                    <p class="section-text">
                        Conforto, praticidade e atendimento de excelência se unem para oferecer uma experiência única e
                        inesquecível
                        em cada detalhe da sua estadia.
                    </p>
                    <ul class="package-list">
                        <ul class="popular-list">
                            <li>
                                <div class="popular-card">
                                    <figure class="card-img">
                                        <img src="./assets/imagens/hosp/saoPaulo/laghettoStilo/entrada.jpg"
                                            alt="San miguel, italy" loading="lazy">
                                    </figure>
                                    <div class="card-content">
                                        <div class="card-rating">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                        <h3 class="h3 card-title">
                                            <a href="#">Laghetto Stilo</a>
                                        </h3>
                                        <p class="card-text">
                                            O Laghetto Stilo São Paulo, localizado na cidade de São Paulo, dispõe de
                                            jardim e bar...
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="popular-card">
                                    <figure class="card-img">
                                        <img src="./assets/imagens/hosp/ubatuba/casaMaria/entrada.png"
                                            alt="San miguel, italy" loading="lazy">
                                    </figure>
                                    <div class="card-content">
                                        <div class="card-rating">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                        <h3 class="h3 card-title">
                                            <a href="#">Casa di Maria</a>
                                        </h3>
                                        <p class="card-text">
                                            O Casa di Maria, em Ubatuba, combina conforto, tranquilidade e contato
                                            com a natureza...
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="popular-card">
                                    <figure class="card-img">
                                        <img src="./assets/imagens/hosp/saoPaulo/H3hotel/entrada.jpg" alt="hotel"
                                            loading="lazy">
                                    </figure>
                                    <div class="card-content">
                                        <div class="card-rating">
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                            <ion-icon name="star"></ion-icon>
                                        </div>
                                        <h3 class="h3 card-title">
                                            <a href="#">H3 Hotel</a>
                                        </h3>
                                        <p class="card-text">
                                            Se você está em busca de uma hospedagem prática, moderna e bem
                                            localizada na capital paulista...
                                        </p>
                                    </div>
                                </div>
                            </li>

                        </ul>

                    </ul>
                    <a href="./hosp.html">
                        <button class="btn btn-primary">Veja mais</button>
                    </a>
                </div>
            </section>

            <!-- destinos -->
            <section class="popular" id="destination">
                <div class="container">
                    <p class="section-subtitle">Pontos turísticos</p>
                    <h2 class="h2 section-title">Destinos mais procurados</h2>
                    <p class="section-text">
                        Descubra os encantos da cidade com os principais pontos turísticos, onde história, cultura e
                        beleza natural se encontram em cada esquina.
                    </p>
                    <ul class="popular-list">

                        <li>
                            <div class="popular-card">
                                <figure class="card-img">
                                    <img src="./assets/imagens/destino/camposJordao/ducha.jpg" alt="San miguel, italy"
                                        loading="lazy">
                                </figure>
                                <div class="card-content">
                                    <p class="card-subtitle">
                                        <a href="#">Cachoeira</a>
                                    </p>
                                    <h3 class="h3 card-title">
                                        <a href="#">Ducha de Prata</a>
                                    </h3>
                                    <p class="card-text">
                                        A Ducha de Prata é um dos pontos turísticos mais tradicionais e...
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="popular-card">
                                <figure class="card-img">
                                    <img src="./assets/imagens/destino/saoPaulo/allianz.jpeg" alt="San miguel, italy"
                                        loading="lazy">
                                </figure>
                                <div class="card-content">
                                    <p class="card-subtitle">
                                        <a href="#">Estádio</a>
                                    </p>
                                    <h3 class="h3 card-title">
                                        <a href="#">Allianz Parque</a>
                                    </h3>
                                    <p class="card-text">
                                        O Allianz Parque, também conhecido como Arena Palmeiras, é um...
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="popular-card">
                                <figure class="card-img">
                                    <img src="./assets/imagens/destino/ubatuba/toninhas.jpg" alt="San miguel, italy"
                                        loading="lazy">
                                </figure>
                                <div class="card-content">
                                    <p class="card-subtitle">
                                        <a href="#">Praia</a>
                                    </p>
                                    <h3 class="h3 card-title">
                                        <a href="#">Praia das Toninhas</a>
                                    </h3>
                                    <p class="card-text">
                                        A Praia das Toninhas, localizada no município de Ubatuba, no litoral...
                                    </p>
                                </div>
                            </div>
                        </li>

                    </ul>
                    <a href="./destinos.html">
                        <button class="btn btn-primary">Veja mais</button>
                    </a>
                </div>
            </section>

            <!-- galeria -->
            <section class="gallery" id="gallery">
                <div class="container"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <p class="section-subtitle">Galeria de fotos</p>
                    <h2 class="h2 section-title">Inspire-se para sua próxima viagem</h2>
                    <p class="section-text">
                        Explore nossa galeria de fotos e descubra os momentos mais marcantes, que refletem a beleza e a
                        história de cada local.
                    </p>
                    <ul class="gallery-list">
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="./assets/imagens/galeria/acquaMundo.png" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="./assets/imagens/galeria/ilhaCabras.png" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="./assets/imagens/galeria/vilaCapivari.jpg" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="./assets/imagens/galeria/memorialPeao.jpg" alt="Gallery image">
                            </figure>
                        </li>
                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="./assets/imagens/galeria/barretosCountry.jpg" alt="Gallery image">
                            </figure>
                        </li>
                    </ul>
                    <a href="./galeria.html">
                        <button class="btn btn-primary" style="margin-top: 50px;">Veja mais</button>
                    </a>
                </div>
            </section>
        </article>
    </main>

    <!-- footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <img src="./assets/imagens/logoBranco.png" alt="Tourly logo">
                    </a>
                    <p class="footer-text">
                        A SSK Tour é uma agência de turismo especializada em acessibilidade. Nosso compromisso é
                        proporcionar
                        experiências de viagem que atendam às necessidades de todos, sem abrir mão de qualidade e
                        segurança.
                    </p>
                </div>
                <div class="footer-contact">
                    <h4 class="contact-title">Contato</h4>
                    <p class="contact-text">
                        Se precisar de ajuda, fale conosco!
                    </p>
                    <ul>
                        <li class="contact-item">
                            <ion-icon name="call-outline"></ion-icon>
                            <a href="tel:+01123456790" class="contact-link">+55 16 99999-9999</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="mail-outline"></ion-icon>
                            <a href="mailto:info.tourly.com" class="contact-link">ssktour@contato.com.br</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="location-outline"></ion-icon>
                            <address>Rua Maranhão, 1225</address>
                        </li>
                    </ul>
                </div>
               
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">
                    &copy; 2025 <a href="">Todos os direitos reservados</a>.
                </p>
                <ul class="footer-bottom-list">
                    <li>
                        <a href="#" class="footer-bottom-link">Política de Privacidade</a>
                    </li>
                    <li>
                        <a href="#" class="footer-bottom-link">Termos e Condições</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- voltar ao topo -->
    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <script src="./assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

</body>

</html>