<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST["idPergunta"] ?? "";
    $pergunta = $_POST["pergunta"] ?? "";
    $resposta = $_POST["resposta"] ?? "";

    try {
        $pdo->beginTransaction();

        $stmtPergunta = $pdo->prepare("UPDATE perguntas SET pergunta = ? WHERE id = ? AND tipo = 'discursiva'");
        $stmtPergunta->execute([$pergunta, $idPergunta]);

        $stmtResposta = $pdo->prepare("UPDATE respostas SET resposta = ? WHERE id_pergunta = ?");
        $stmtResposta->execute([$resposta, $idPergunta]);

        $pdo->commit();
        echo "Pergunta discursiva alterada com sucesso!";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao alterar pergunta: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["idPergunta"])) {
    header("Content-Type: application/json; charset=utf-8");
    $idPergunta = $_GET["idPergunta"];

    $stmt = $pdo->prepare("
        SELECT p.id, p.pergunta, r.resposta
        FROM perguntas p
        LEFT JOIN respostas r ON r.id_pergunta = p.id
        WHERE p.id = ? AND p.tipo = 'discursiva'
    ");
    $stmt->execute([$idPergunta]);
    $dados = $stmt->fetch();

    if ($dados) {
        echo json_encode([
            "encontrada" => true,
            "idPergunta" => $dados["id"],
            "pergunta" => $dados["pergunta"],
            "resposta" => $dados["resposta"] ?? ""
        ]);
    } else {
        echo json_encode([
            "encontrada" => false,
            "idPergunta" => $idPergunta,
            "pergunta" => "",
            "resposta" => ""
        ]);
    }
}