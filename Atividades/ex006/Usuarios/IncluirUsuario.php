<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if (!file_exists("Usuarios.txt")) {
        $arqUsuarios = fopen("Usuarios.txt", "w") or die("Erro ao criar arquivo");
        $linha = "matricula;nome;email\n";
        fwrite($arqUsuarios, $linha);
        fclose($arqUsuarios);
    }

    $arqUsuarios = fopen("Usuarios.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $matricula . ";" . $nome . ";" . $email . "\n";
    fwrite($arqUsuarios, $linha);
    fclose($arqUsuarios);

    echo "Inclusão bem sucedida!";
}
?>