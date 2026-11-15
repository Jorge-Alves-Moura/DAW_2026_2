<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["matricula"])) {
    $matricula = trim($_GET["matricula"]);
    $encontrado = false;
    $nome = "";
    $email = "";

    $arqUsuarios = fopen("Usuarios.txt", "r") or die("Erro ao abrir arquivo!");
    while (!feof($arqUsuarios)) {
        $linha = fgets($arqUsuarios);
        if ($linha == false) {
            break;
        }
        $dados = explode(";", $linha);
        if (trim($dados[0]) == $matricula) {
            $encontrado = true;
            $nome = trim($dados[1]);
            $email = trim($dados[2]);
            break;
        }
    }
    fclose($arqUsuarios);

    echo json_encode([
        "encontrado" => $encontrado,
        "matricula" => $matricula,
        "nome" => $nome,
        "email" => $email
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = trim($_POST["matricula"]);
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arqUsuarios = fopen("Usuarios.txt", "r") or die("Erro ao abrir arquivo!");
    $arqNovo = fopen("Usuarios_novo.txt", "w") or die("Erro ao criar!");

    while (!feof($arqUsuarios)) {
        $linha = fgets($arqUsuarios);
        if ($linha == false) {
            break;
        }
        $dados = explode(";", $linha);

        if (trim($dados[0]) == $matricula) {
            $linha = $matricula . ";" . $nome . ";" . $email . "\n";
        }
        fwrite($arqNovo, $linha);
    }
    fclose($arqUsuarios);
    fclose($arqNovo);

    unlink("Usuarios.txt");
    rename("Usuarios_novo.txt", "Usuarios.txt");
    $msg = "Alteraçao bem sucedida";
    echo $msg;
}
?>