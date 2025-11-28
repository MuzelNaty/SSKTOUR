<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado</title>
        <link rel="shortcut icon" href="./assets/imagens/icon.png" type="image/svg+xml">
        <link rel="stylesheet" href="./assets/css/outros.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    </head>

    <body id="top">
        <?php
        require_once "conexao/conexao.php";

        $cidade = $_GET['cidade'] ?? null;
        $hotel = $_GET['hotel'] ?? null;
        $deficiencia = $_GET['deficiencia'] ?? null;
        $ponto = $_GET['ponto-turistico'] ?? null;

        $sql = "
        SELECT
            h.id,
            h.nome AS hotel,
            h.site,
            c.nome AS cidade,
            GROUP_CONCAT(DISTINCT d.tipo SEPARATOR ', ') AS deficiencias,
            GROUP_CONCAT(DISTINCT p.nome SEPARATOR ', ') AS pontos_turisticos
        FROM Hotel h
        JOIN Cidade c ON h.cidade_id = c.id
        LEFT JOIN Hotel_Deficiencia hd ON h.id = hd.hotel_id
        LEFT JOIN Deficiencia d ON hd.deficiencia_id = d.id
        LEFT JOIN Hotel_PontoTuristico hp ON h.id = hp.hotel_id
        LEFT JOIN PontoTuristico p ON hp.ponto_turistico_id = p.id
        WHERE
            (COALESCE(:cidade, '') = '' OR c.nome LIKE CONCAT('%', :cidade, '%'))
            AND (COALESCE(:hotel, '') = '' OR h.nome LIKE CONCAT('%', :hotel, '%'))
            AND (COALESCE(:deficiencia, '') = '' OR EXISTS (
                SELECT 1 FROM Hotel_Deficiencia hd2
                JOIN Deficiencia d2 ON hd2.deficiencia_id = d2.id
                WHERE hd2.hotel_id = h.id
                AND d2.tipo LIKE CONCAT('%', :deficiencia, '%')
            ))
            AND (COALESCE(:ponto_turistico, '') = '' OR EXISTS (
                SELECT 1 FROM Hotel_PontoTuristico hp2
                JOIN PontoTuristico p2 ON hp2.ponto_turistico_id = p2.id
                WHERE hp2.hotel_id = h.id
                AND p2.nome LIKE CONCAT('%', :ponto_turistico, '%')
            ))
        GROUP BY h.id, h.nome, h.site, c.nome
        ORDER BY h.nome;

        ";

        $conexao = new Conexao();
        $pdo = $conexao->conectar();

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'cidade' => $cidade ?: null,
            'hotel' => $hotel ?: null,
            'deficiencia' => $deficiencia ?: null,
            'ponto_turistico' => $ponto ?: null,
        ]);


        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $totalResultados = count($resultados);
        ?>

        <main>
            <article>
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
                    </div>
                </header>

                <!-- Resultados Section -->
                    <section class="package" id="resultados" style="background: var(--cultured);">
                        <div class="container">
                            <?php if ($totalResultados > 0): ?>
                                <h2 class="h2 section-title">Resultados da sua busca</h2>
                                <p class="section-text">
                                <?php if ($totalResultados > 0): ?>
                                    Encontramos <?php echo $totalResultados; ?> <?php echo $totalResultados == 1 ? 'hotel' : 'hotéis'; ?> que atenda aos seus critérios
                                <?php else: ?>
                                    Nenhum hotel encontrado com os critérios especificados
                                <?php endif; ?>
                                </p>

                                <ul class="popular-list" style="margin-bottom: 0;">
                                    <?php foreach ($resultados as $row): ?>
                                        <li>
                                            <div class="popular-card" style="background: var(--white); border-radius: var(--radius-25); padding: 0; height: auto; min-height: 400px;">
                                                <div style="padding: 30px;">
                                                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
                                                        <div style="flex: 1; min-width: 250px;">
                                                            <h3 class="h3 card-title" style="color: var(--gunmetal); margin-bottom: 10px;">
                                                                <?php echo htmlspecialchars($row['hotel']); ?>
                                                            </h3>
                                                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                                                                <ion-icon name="location-outline" style="color: var(--bright-navy-blue); font-size: 20px;"></ion-icon>
                                                                <span style="color: var(--blue-ncs); font-weight: var(--fw-600);">
                                                                    <?php echo htmlspecialchars($row['cidade']); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div style="display: grid; gap: 20px;">

                                                        <!-- Deficiências -->
                                                        <div style="background: var(--cultured); padding: 20px; border-radius: var(--radius-15); border-left: 4px solid var(--bright-navy-blue);">
                                                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                                                <ion-icon name="accessibility-outline" style="color: var(--bright-navy-blue); font-size: 24px;"></ion-icon>
                                                                <h4 style="color: var(--gunmetal); font-weight: var(--fw-700); font-size: var(--fs-4); margin: 0;">
                                                                    Acessibilidades
                                                                </h4>
                                                            </div>
                                                            <p style="color: var(--black-coral); margin: 0; line-height: 1.6;">
                                                                <?php 
                                                                if ($row['deficiencias']) {
                                                                    echo htmlspecialchars($row['deficiencias']);
                                                                } else {
                                                                    echo '<span style="color: var(--spanish-gray); font-style: italic;">Não especificado</span>';
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>

                                                        <!-- Pontos Turísticos -->
                                                            <div style="background: var(--cultured); padding: 20px; border-radius: var(--radius-15); border-left: 4px solid var(--tiffany);">
                                                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                                                    <ion-icon name="map-outline" style="color: var(--tiffany); font-size: 24px;"></ion-icon>
                                                                    <h4 style="color: var(--gunmetal); font-weight: var(--fw-700); font-size: var(--fs-4); margin: 0;">
                                                                        Pontos turísticos próximos
                                                                    </h4>
                                                                </div>
                                                                <p style="color: var(--black-coral); margin: 0; line-height: 1.6;">
                                                                    <?php 
                                                                    if ($row['pontos_turisticos']) {
                                                                        echo htmlspecialchars($row['pontos_turisticos']);
                                                                    } else {
                                                                        echo '<span style="color: var(--spanish-gray); font-style: italic;">Não especificado</span>';
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>

                                                    </div>
                                                    

                                                    <?php if ($row['site']): ?>
                                                            <a href="<?php echo htmlspecialchars($row['site']); ?>" 
                                                            target="_blank" 
                                                            class="btn btn-primary" 
                                                            style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; white-space: nowrap;">
                                                                Visitar hotel
                                                            </a>
                                                        <?php endif; ?>
                                                </div>
                                                
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <!-- Botão Voltar -->
                                <div style="text-align: center; margin-top: 50px;">
                                    <a href="index.php" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                                        Realizar Nova Pesquisa
                                    </a>
                                </div>

                            <?php else: ?>
                                <!-- Nenhum resultado -->
                                <div style="text-align: center; padding: 60px 20px;">
                                    <h2 class="h2 section-title" style="margin-bottom: 20px;">Nenhum resultado encontrado</h2>
                                    <p class="section-text" style="max-width: 600px; margin: 0 auto 40px;">
                                        Não encontramos hotéis que correspondam aos seus critérios de pesquisa. 
                                        Tente fazer uma nova busca.
                                    </p>
                                    <a href="index.php" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                                        Voltar para Início
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>

            </article>
        </main>
        <!-- voltar ao topo -->
        <a href="#top" class="go-top" data-go-top>
            <ion-icon name="chevron-up-outline"></ion-icon>
        </a>

        <script src="./assets/js/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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
