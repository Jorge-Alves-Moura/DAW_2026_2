<?php
if (file_exists("Perguntas Multipla.txt") && file_exists("Respostas Multipla.txt")) {
    $arqPerguntaMultipla = fopen("Perguntas Multipla.txt", "r") or die("Erro ao abrir arquivo");
    while (!feof($arqPerguntaMultipla)) {
        $linha = fgets($arqPerguntaMultipla);
        if ($linha == false || trim($linha) == "") {
            continue;
        }
        $dados = explode(";", $linha);
        if (trim($dados[0]) == "id") {
            continue;
        }
        $idPergunta = trim($dados[0]);
        $pergunta = trim($dados[1]);

        echo "<tr>";
        echo "<td>Múltipla escolha</td>";
        echo "<td>$idPergunta</td>";
        echo "<td>$pergunta</td>";
        echo "<td>";

        $arqResposta = fopen("Respostas Multipla.txt", "r") or die("Erro ao abrir arquivo");
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
                echo trim($dadosResposta[2]) . " (Gabarito: " . trim($dadosResposta[3]) . ")<br>";
            }
        }
        fclose($arqResposta);

        echo "</td>";
        echo "<td>";
        echo "<a href='ExibirQuestao.html?idPergunta=$idPergunta&tipo=multipla'><button>Exibir</button></a> ";
        echo "<a href='AlterarQuestao-MultiplaEscolha.html?idPergunta=$idPergunta'><button>Alterar</button></a> ";
        echo "<input type='button' value='Excluir' onclick=\"ExcluirDaLista('$idPergunta', 'multipla')\">";
        echo "</td>";
        echo "</tr>";
    }
    fclose($arqPerguntaMultipla);
}

if (file_exists("Perguntas Discursivas.txt") && file_exists("Respostas Discursivas.txt")) {
    $arqPerguntaDiscursiva = fopen("Perguntas Discursivas.txt", "r") or die("Erro ao abrir arquivo");
    while (!feof($arqPerguntaDiscursiva)) {
        $linha = fgets($arqPerguntaDiscursiva);
        if ($linha == false || trim($linha) == "") {
            continue;
        }
        $dados = explode(";", $linha);
        if (trim($dados[0]) == "id") {
            continue;
        }
        $idPergunta = trim($dados[0]);
        $pergunta = trim($dados[1]);

        echo "<tr>";
        echo "<td>Discursiva</td>";
        echo "<td>$idPergunta</td>";
        echo "<td>$pergunta</td>";
        echo "<td>";

        $arqResposta = fopen("Respostas Discursivas.txt", "r") or die("Erro ao abrir arquivo");
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
                echo trim($dadosResposta[1]);
            }
        }
        fclose($arqResposta);

        echo "</td>";
        echo "<td>";
        echo "<a href='ExibirQuestao.html?idPergunta=$idPergunta&tipo=discursiva'><button>Exibir</button></a> ";
        echo "<a href='AlterarQuestao-Discursiva.html?idPergunta=$idPergunta'><button>Alterar</button></a> ";
        echo "<input type='button' value='Excluir' onclick=\"ExcluirDaLista('$idPergunta', 'discursiva')\">";
        echo "</td>";
        echo "</tr>";
    }
    fclose($arqPerguntaDiscursiva);
}
