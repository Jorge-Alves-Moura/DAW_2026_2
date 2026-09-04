```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arqAlunos = fopen("Alunos.txt", "r") or die("erro ao abrir arquivo");
    $arqNovo = fopen("Alunos_novo.txt", "w") or die("erro ao criar arquivo");

    while (!feof($arqAlunos)) {
        $linha = fgets($arqAlunos);

        if ($linha == false) {
            break;
        }

        $dados = explode(";", $linha);

        // Mantém o cabeçalho
        if ($dados[0] == "nome") {
            fwrite($arqNovo, $linha);
        }
        // Se encontrou a matrícula, grava os novos dados
        else if (trim($dados[1]) == $matricula) {
            $novaLinha = $nome . ";" . $matricula . ";" . $email . "\n";
            fwrite($arqNovo, $novaLinha);
        }
        // Se não encontrou, mantém a linha original
        else {
            fwrite($arqNovo, $linha);
        }
    }

    fclose($arqAlunos);
    fclose($arqNovo);

    unlink("Alunos.txt");
    rename("Alunos_novo.txt", "Alunos.txt");
}
?>