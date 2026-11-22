<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST["idPergunta"] ?? "";
    $pergunta = $_POST["pergunta"] ?? "";

    if (isset($_POST["resposta"]) && isset($_POST["gabarito"])) {
        $respostas = $_POST["resposta"];
        $gabaritos = $_POST["gabarito"];

        try {
            $pdo->beginTransaction();

            $stmtPergunta = $pdo->prepare("UPDATE perguntas SET pergunta = ? WHERE id = ? AND tipo = 'multipla'");
            $stmtPergunta->execute([$pergunta, $idPergunta]);

            $stmtDelete = $pdo->prepare("DELETE FROM respostas WHERE id_pergunta = ?");
            $stmtDelete->execute([$idPergunta]);

            $stmtInsert = $pdo->prepare("
                INSERT INTO respostas (id_pergunta, ordem, resposta, gabarito)
                VALUES (?, ?, ?, ?)
            ");

            for ($i = 0; $i < count($respostas); $i++) {
                $stmtInsert->execute([
                    $idPergunta,
                    $i + 1,
                    $respostas[$i],
                    $gabaritos[$i]
                ]);
            }

            $pdo->commit();
            echo "Pergunta de múltipla escolha alterada com sucesso!";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Erro ao alterar pergunta: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["idPergunta"])) {
    header("Content-Type: application/json; charset=utf-8");
    $idPergunta = $_GET["idPergunta"];
    $perguntaEncontrada = false;
    $pergunta = "";
    $respostas = [];
    $gabaritos = [];

    $stmtPergunta = $pdo->prepare("SELECT id, pergunta FROM perguntas WHERE id = ? AND tipo = 'multipla'");
    $stmtPergunta->execute([$idPergunta]);
    $dadosPergunta = $stmtPergunta->fetch();

    if ($dadosPergunta) {
        $perguntaEncontrada = true;
        $pergunta = $dadosPergunta["pergunta"];

        $stmtRespostas = $pdo->prepare("
            SELECT resposta, gabarito
            FROM respostas
            WHERE id_pergunta = ?
            ORDER BY ordem ASC, id ASC
        ");
        $stmtRespostas->execute([$idPergunta]);

        while ($row = $stmtRespostas->fetch()) {
            $respostas[] = $row["resposta"];
            $gabaritos[] = (string)$row["gabarito"];
        }
    }

    echo json_encode([
        "encontrada" => $perguntaEncontrada,
        "idPergunta" => $idPergunta,
        "pergunta" => $pergunta,
        "respostas" => $respostas,
        "gabaritos" => $gabaritos
    ]);
}