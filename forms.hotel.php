<?php 
    if(isset($_GET['metodo']))
    {
        $metodo = $_GET['metodo'];
        $idh = $_GET['idp'];
        $acaoh = 'recuperarHotel'; 
        require_once 'hotel.controller.php';
        foreach ($pontoT as $key => $pontoT) 
        {
            $nome = $hotel->nome;
            $endereco = $hotel->endereco;
            $id= $hotel->id;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Hotel</title>
    <link rel="shortcut icon" href="./assets/imagens/icon.png" type="image/svg+xml">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/outros.css">
    <link rel="stylesheet" href="./assets/css/forms.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header class="header" data-header>
        <div class="overlay" data-overlay></div>
        <div class="header-top">
            <div class="container">
                <div class="header-btn-group">
                    <button class="nav-open-btn" aria-label="Abrir Menu" data-nav-open-btn>
                        <ion-icon name="menu-outline"></ion-icon>
                    </button>
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
                                <a href="index.html" class="navbar-link" data-nav-link>Início</a>
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
        </div>
    </header>

    <!-- formulário -->
    <main>
        <section class="form-container">
            <div class="container">
                <div class="form-wrapper">
                    <div class="form-header">
                        <h1 class="form-title">Formulário Hotel</h1>
                        <p class="form-subtitle">
                            Preencha os campos abaixo com informações do hotel
                        </p>
                    </div>

                    <form id="contactForm" class="contact-form" action="hotel.controller.php?acaoc=<?php if(!isset($metodo)){echo 'inserir';}else if($metodo == 'alterar'){echo 'alterar';}else if($metodo == 'excluir'){echo 'excluir';}?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-input" value="<?php if(isset($nome)){echo $nome;}else{ echo '';}; ?>">
                            </div>
                            <div class="form-group">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="endereco" id="endereco" name="endereco" class="form-input" value="<?php if(isset($endereco)){echo $endereco;}else{ echo '';}; ?>">>
                            </div>
                        </div>
                        <input type="hidden" name="idh" value="<?php if(isset($id)){echo $id;}else{ echo '';}; ?>" >

                        <button type="submit" class="form-submit" id="submitBtn">
                            <?php if(!isset($metodo)){echo 'inserir';}else if($metodo == 'alterar'){echo 'alterar';}else if($metodo == 'excluir'){echo 'excluir';}?>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="./assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>