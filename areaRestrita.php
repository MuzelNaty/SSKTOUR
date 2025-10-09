<?php 
    $acaoc = 'recuperar';
    require_once 'cidade.controller.php';
    $acaoh = 'recuperar';
    require_once 'hotel.controller.php';
    $acaop = 'recuperar';
    require_once 'pontoT.controller.php';
    $acaoa = 'recuperar';
    require_once 'aces.controller.php';
    $acaod = 'recuperar';
    require_once 'def.controller.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Área Restrita</title>
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

        <main>
            <section class="form-container">

                <div class="container">
                    <div class="form-wrapper">
                        <div class="form-header">
                            <h1 class="form-title">Cidades</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Nome
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col"> 
                                        </th>
                                    </tr>
                                </thead>
                                <?php foreach($cidade as $key => $cidade){?>

                                <tbody>
                                    <tr>
                                        <td><?= $cidade->nome?></td>
                                        <td><a href="forms.cidade.php?metodo=alterar&idc=<?= $cidade->id?>"> Alterar</a></td>
                                        <td><a href="forms.cidade.php?metodo=excluir&idc=<?= $cidade->id?>"> Excluir</a></td>
                                    </tr>
                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>

                    <div class="form-wrapper">
                        <div class="form-header">
                            <h1 class="form-title">Hotéis</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Nome
                                        </th>
                                        <th scope="col">
                                            Endereço
                                        </th>
                                        <th scope="col"> 
                                        </th>
                                    </tr>
                                </thead>
                                <?php foreach($hotel as $key => $hotel){?>

                                <tbody>
                                    <tr>
                                        <td><?= $hotel->nome?></td>
                                        <td><?= $hotel->endereco?></td>
                                        <td><a href="forms.hotel.php?metodo=alterar&idh=<?= $hotel->id?>"> Alterar</a></td>
                                        <td><a href="forms.hotel.php?metodo=excluir&idh=<?= $hotel->id?>"> Excluir</a></td>
                                    </tr>
                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>

                    <div class="form-wrapper">
                        <div class="form-header">
                            <h1 class="form-title">Ponto Turístico</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Nome
                                        </th>
                                        <th scope="col">
                                            Endereço
                                        </th>
                                    </tr>
                                </thead>
                                <?php foreach($pontoT as $key => $pontoT){?>

                                <tbody>
                                    <tr>
                                        <td><?= $pontoT->nome?></td>
                                        <td><?= $pontoT->endereco?></td>
                                        <td><a href="forms.pontoT.php?metodo=alterar&idp=<?= $pontoT->id?>"> Alterar</a></td>
                                        <td><a href="forms.pontoT.php?metodo=excluir&idp=<?= $pontoT->id?>"> Excluir</a></td>
                                    </tr>
                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>

                    <div class="form-wrapper">
                        <div class="form-header">
                            <h1 class="form-title">Acessibilidade</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Tipo
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </thead>
                                <?php foreach($aces as $key => $aces){?>

                                <tbody>
                                    <tr>
                                        <td><?= $aces->tipo?></td>
                                        <td><a href="forms.aces.php?metodo=alterar&ida=<?= $aces->id?>"> Alterar</a></td>
                                        <td><a href="forms.aces.php?metodo=excluir&ida=<?= $aces->id?>"> Excluir</a></td>
                                    </tr>
                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>

                    <div class="form-wrapper">
                        <div class="form-header">
                            <h1 class="form-title">Deficiência</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Tipo
                                        </th>
                                        <th scope="col">
                                        </th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                </thead>
                                <?php foreach($def as $key => $def){?>

                                <tbody>
                                    <tr>
                                        <td><?= $def->tipo?></td>
                                        <td><a href="forms.def.php?metodo=alterar&idd=<?= $def->id ?>"> Alterar</a></td>
                                        <td><a href="forms.def.php?metodo=excluir&idd=<?= $def->id ?>"> Excluir</a></td>
                                    </tr>
                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>

                </div>
            </section>
        </main>
        
    </body>
</html>