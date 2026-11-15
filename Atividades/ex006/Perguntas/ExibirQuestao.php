<?php
$idPergunta = $_GET["idPergunta"];
$tipo = $_GET["tipo"];

if ($tipo == "discursiva") {
    $nomeArqPergunta = "Perguntas Discursivas.txt";
    $nomeArqResposta = "Respostas Discursivas.txt";
} else {
    $nomeArqPergunta = "Perguntas Multipla.txt";
    $nomeArqResposta = "Respostas Multipla.txt";
}

$arqPergunta = fopen($nomeArqPergunta, "r") or die("Erro ao abrir arquivo");

while (!feof($arqPergunta)) {
    $linha = fgets($arqPergunta);
    if ($linha == false || trim($linha) == "") {
        continue;
    }
    $dados = explode(";", $linha);
    if (trim($dados[0]) == "id") {
        continue;
    }
    if (trim($dados[0]) == $idPergunta) {
        $id = trim($dados[0]);
        $pergunta = trim($dados[1]);

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$pergunta</td>";
        echo "<td>";

        $arqResposta = fopen($nomeArqResposta, "r") or die("Erro ao abrir arquivo");
        while (!feof($arqResposta)) {
            $linhaResposta = fgets($arqResposta);
            if ($linhaResposta == false || trim($linhaResposta) == "") {
                continue;
            }
            $dadosResposta = explode(";", $linhaResposta);
            if (trim($dadosResposta[0]) == "idPergunta") {
                continue;
            }
            if (trim($dadosResposta[0]) == $idPergunta) {
                if ($tipo == "discursiva") {
                    echo trim($dadosResposta[1]);
                } else {
                    echo trim($dadosResposta[2]);
                    if (trim($dadosResposta[3]) == "1") {
                        echo " (Gabarito)";
                    }
                    echo "<br>";
                }
            }
        }
        fclose($arqResposta);

        echo "</td>";
        echo "</tr>";
    }
}
fclose($arqPergunta);
