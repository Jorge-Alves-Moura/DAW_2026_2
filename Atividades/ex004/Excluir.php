<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST["matricula"];

    $arqDisc = fopen("Alunos.txt", "r") or die("erro ao abrir arquivo");
    $arqNovo = fopen("Alunos_novo.txt", "w") or die("erro ao criar arquivo");

    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);

        if ($linha == false) {
            break;
        }

        $dados = explode(";", $linha);

        if ($dados[1] != $matricula) {
            fwrite($arqNovo, $linha);
        }
    }

    fclose($arqDisc);
    fclose($arqNovo);

    unlink("Alunos.txt");
    rename("Alunos_novo.txt", "Alunos.txt");
}
?>