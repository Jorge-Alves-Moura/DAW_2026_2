<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta = $_POST["pergunta"];
    $quantidade = $_POST["quantidade"];

    if (!file_exists("Perguntas Multipla.txt")) {
        $arqPergunta = fopen("Perguntas Multipla.txt", "w") or die("Erro ao criar o arquivo");
        $arqResposta = fopen("Respostas Multipla.txt", "w") or die("Erro ao criar o arquivo");

        $linhaPergunta = "id;pergunta\n";
        $linhaResposta = "idPergunta;idResposta;resposta;gabarito\n";

        fwrite($arqPergunta, $linhaPergunta);
        fwrite($arqResposta, $linhaResposta);

        fclose($arqPergunta);
        fclose($arqResposta);
    }

    $arqPergunta = fopen("Perguntas Multipla.txt", "r") or die("Erro ao abrir o arquivo");
    $idPergunta = 0;

    while (!feof($arqPergunta)) {
        $linha = fgets($arqPergunta);
        if ($linha != "") {
            $dados = explode(";", $linha);
            if (is_numeric(trim($dados[0]))) {
                $idPergunta = trim($dados[0]);
            }
        }
    }

    $idPergunta = $idPergunta + 1;
    fclose($arqPergunta);

    if (isset($_POST["resposta"])) {
        $respostas = $_POST["resposta"];
        $gabaritos = $_POST["gabarito"];

        $arqPergunta = fopen("Perguntas Multipla.txt", "a") or die("Erro ao incluir pergunta!");
        $arqResposta = fopen("Respostas Multipla.txt", "a") or die("Erro ao incluir resposta!");

        $linhaPergunta = $idPergunta . ";" . $pergunta . "\n";
        fwrite($arqPergunta, $linhaPergunta);

        $idResposta = 1;
        while ($idResposta <= $quantidade) {
            $resposta = $respostas[$idResposta - 1];
            $gabarito = $gabaritos[$idResposta - 1];

            $linhaResposta = $idPergunta . ";" . $idResposta . ";" . $resposta . ";" . $gabarito . "\n";
            fwrite($arqResposta, $linhaResposta);

            $idResposta = $idResposta + 1;
        }

        fclose($arqPergunta);
        fclose($arqResposta);

        echo "Pergunta cadastrada com sucesso!";
    }
}
?>