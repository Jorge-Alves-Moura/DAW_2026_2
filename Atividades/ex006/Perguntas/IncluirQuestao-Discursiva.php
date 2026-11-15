<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];

    if (!file_exists("Perguntas Discursivas.txt")) {
        $arqPergunta = fopen("Perguntas Discursivas.txt", "w") or die("Erro ao criar arquivo");
        $arqResposta = fopen("Respostas Discursivas.txt", "w") or die("Erro ao criar arquivo");
        $linhaPergunta = "id;pergunta\n";
        $linhaResposta = "idPergunta;resposta\n";
        fwrite($arqPergunta, $linhaPergunta);
        fwrite($arqResposta, $linhaResposta);
        fclose($arqPergunta);
        fclose($arqResposta);
    }

    $arqPergunta = fopen("Perguntas Discursivas.txt", "r") or die("Erro ao incluir pergunta");
    $idPergunta = 0;
    while (!feof($arqPergunta)) {
        $linhaPergunta = fgets($arqPergunta);
        if ($linhaPergunta != "") {
            $dados = explode(";", $linhaPergunta);
            if (is_numeric(trim($dados[0]))) {
                $idPergunta = trim($dados[0]);
            }
        }
    }
    $idPergunta = $idPergunta + 1;
    fclose($arqPergunta);

    $arqPergunta = fopen("Perguntas Discursivas.txt", "a") or die("Erro ao incluir pergunta");
    $arqResposta = fopen("Respostas Discursivas.txt", "a") or die("Erro ao incluir resposta");

    $linhaPergunta = $idPergunta . ";" . $pergunta . "\n";
    $linhaResposta = $idPergunta . ";" . $resposta . "\n";
    fwrite($arqPergunta, $linhaPergunta);
    fwrite($arqResposta, $linhaResposta);
    fclose($arqPergunta);
    fclose($arqResposta);

    echo "Pergunta discursiva cadastrada com sucesso!";
}
?>