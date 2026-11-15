<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = $_POST["idPergunta"];
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];

    $arqPergunta = fopen("Perguntas Discursivas.txt", "r") or die("Erro ao abrir o arquivo");
    $arqNovo = fopen("Perguntas Discursivas Novo.txt", "w") or die("Erro ao criar o arquivo");

    while (!feof($arqPergunta)) {
        $linha = fgets($arqPergunta);
        if ($linha != "") {
            $dados = explode(";", $linha);
            if (trim($dados[0]) == "id") {
                fwrite($arqNovo, $linha);
            } else if (trim($dados[0]) == $idPergunta) {
                $linhaPergunta = $idPergunta . ";" . $pergunta . "\n";
                fwrite($arqNovo, $linhaPergunta);
            } else {
                fwrite($arqNovo, $linha);
            }
        }
    }
    fclose($arqPergunta);
    fclose($arqNovo);

    unlink("Perguntas Discursivas.txt");
    rename("Perguntas Discursivas Novo.txt", "Perguntas Discursivas.txt");

    $arqResposta = fopen("Respostas Discursivas.txt", "r") or die("Erro ao abrir o arquivo");
    $arqNovo = fopen("Respostas Discursivas Novo.txt", "w") or die("Erro ao criar o arquivo");

    while (!feof($arqResposta)) {
        $linha = fgets($arqResposta);
        if ($linha != "") {
            $dados = explode(";", $linha);
            if (trim($dados[0]) == "idPergunta") {
                fwrite($arqNovo, $linha);
            } else if (trim($dados[0]) == $idPergunta) {
                $linhaResposta = $idPergunta . ";" . $resposta . "\n";
                fwrite($arqNovo, $linhaResposta);
            } else {
                fwrite($arqNovo, $linha);
            }
        }
    }
    fclose($arqResposta);
    fclose($arqNovo);

    unlink("Respostas Discursivas.txt");
    rename("Respostas Discursivas Novo.txt", "Respostas Discursivas.txt");

    echo "Pergunta discursiva alterada com sucesso!";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["idPergunta"])) {
    $idPergunta = $_GET["idPergunta"];
    $perguntaEncontrada = false;
    $pergunta = "";
    $resposta = "";

    $arqPergunta = fopen("Perguntas Discursivas.txt", "r") or die("Erro ao abrir o arquivo");
    while (!feof($arqPergunta)) {
        $linha = fgets($arqPergunta);
        if ($linha != "") {
            $dados = explode(";", $linha);
            if (isset($dados[1]) && trim($dados[0]) == $idPergunta) {
                $pergunta = trim($dados[1]);
                $perguntaEncontrada = true;
            }
        }
    }
    fclose($arqPergunta);

    if ($perguntaEncontrada) {
        $arqResposta = fopen("Respostas Discursivas.txt", "r") or die("Erro ao abrir o arquivo");
        while (!feof($arqResposta)) {
            $linha = fgets($arqResposta);
            if ($linha != "") {
                $dados = explode(";", $linha);
                if (isset($dados[1]) && trim($dados[0]) == $idPergunta) {
                    $resposta = trim($dados[1]);
                }
            }
        }
        fclose($arqResposta);
    }

    echo json_encode([
        "encontrada" => $perguntaEncontrada,
        "idPergunta" => $idPergunta,
        "pergunta" => $pergunta,
        "resposta" => $resposta
    ]);
}
