<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta = $_POST["pergunta"] ?? "";
    $quantidade = (int)($_POST["quantidade"] ?? 0);

    if (isset($_POST["resposta"]) && isset($_POST["gabarito"])) {
        $respostas = $_POST["resposta"];
        $gabaritos = $_POST["gabarito"];

        try {
            $pdo->beginTransaction();

            $stmtPergunta = $pdo->prepare("INSERT INTO perguntas (pergunta, tipo) VALUES (?, 'multipla')");
            $stmtPergunta->execute([$pergunta]);
            $idPergunta = $pdo->lastInsertId();

            $stmtResposta = $pdo->prepare("
                INSERT INTO respostas (id_pergunta, ordem, resposta, gabarito)
                VALUES (?, ?, ?, ?)
            ");

            $idResposta = 1;
            while ($idResposta <= $quantidade) {
                $resposta = $respostas[$idResposta - 1];
                $gabarito = $gabaritos[$idResposta - 1];

                $stmtResposta->execute([$idPergunta, $idResposta, $resposta, $gabarito]);
                $idResposta = $idResposta + 1;
            }

            $pdo->commit();
            echo "Pergunta cadastrada com sucesso!";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Erro ao cadastrar pergunta: " . $e->getMessage();
        }
    }
}