<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST["idPergunta"] ?? "";
    $tipo = $_POST["tipo"] ?? "";

    try {
        $stmt = $pdo->prepare("DELETE FROM perguntas WHERE id = ? AND tipo = ?");
        $stmt->execute([$idPergunta, $tipo]);

        if ($stmt->rowCount() > 0) {
            echo "Pergunta excluída com sucesso!";
        } else {
            echo "Pergunta não encontrada!";
        }
    } catch (Exception $e) {
        echo "Erro ao excluir pergunta: " . $e->getMessage();
    }
}