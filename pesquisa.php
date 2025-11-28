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

foreach ($resultados as $row) {
    echo "<p><strong>Hotel:</strong> {$row['hotel']}<br>";
    echo "<strong>Cidade:</strong> {$row['cidade']}<br>";
    echo "<strong>Deficiências:</strong> " . ($row['deficiencias'] ?: '—') . "<br>";
    echo "<strong>Pontos turísticos:</strong> " . ($row['pontos_turisticos'] ?: '—') . "</p><hr>";
    echo "<strong>Página:</strong> " . 
     ($row['site'] ? "<a href='{$row['site']}' target='_blank'>Visitar</a>" : '—') 
     . "</p><hr>";

}
?>
