<?php
require_once "../conexao.php";

$idPergunta = $_GET["idPergunta"] ?? "";
$tipo = $_GET["tipo"] ?? "";

$stmtPergunta = $pdo->prepare("SELECT id, pergunta, tipo FROM perguntas WHERE id = ? AND tipo = ?");
$stmtPergunta->execute([$idPergunta, $tipo]);
$dadosPergunta = $stmtPergunta->fetch();

if ($dadosPergunta) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($dadosPergunta["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($dadosPergunta["pergunta"]) . "</td>";
    echo "<td>";

    $stmtRespostas = $pdo->prepare("
        SELECT resposta, gabarito
        FROM respostas
        WHERE id_pergunta = ?
        ORDER BY ordem ASC, id ASC
    ");
    $stmtRespostas->execute([$idPergunta]);

    while ($resp = $stmtRespostas->fetch()) {
        echo htmlspecialchars($resp["resposta"]);
        if ($dadosPergunta["tipo"] == "multipla") {
            if ($resp["gabarito"] == 1) {
                echo " (Gabarito)";
            }
            echo "<br>";
        }
    }

    echo "</td>";
    echo "</tr>";
}