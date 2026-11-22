<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta = $_POST["pergunta"] ?? "";
    $resposta = $_POST["resposta"] ?? "";

    try {
        $pdo->beginTransaction();

        $stmtPergunta = $pdo->prepare("INSERT INTO perguntas (pergunta, tipo) VALUES (?, 'discursiva')");
        $stmtPergunta->execute([$pergunta]);
        $idPergunta = $pdo->lastInsertId();

        $stmtResposta = $pdo->prepare("INSERT INTO respostas (id_pergunta, ordem, resposta, gabarito) VALUES (?, 1, ?, 1)");
        $stmtResposta->execute([$idPergunta, $resposta]);

        $pdo->commit();
        echo "Pergunta discursiva cadastrada com sucesso!";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erro ao cadastrar pergunta: " . $e->getMessage();
    }
}