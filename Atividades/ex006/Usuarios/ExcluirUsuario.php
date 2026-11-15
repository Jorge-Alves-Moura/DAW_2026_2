<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["matricula"])) {
    $matricula = trim($_GET["matricula"]);

    $arqUsuarios = fopen("Usuarios.txt", "r") or die("Erro ao abrir arquivo!");
    $arqNovo = fopen("Usuarios_novo.txt", "w") or die("Erro ao criar!");

    while (!feof($arqUsuarios)) {
        $linha = fgets($arqUsuarios);

        if ($linha == false) {
            break;
        }
        $dados = explode(";", $linha);

        if (trim($dados[0]) != $matricula) {
            fwrite($arqNovo, $linha);
        }
    }

    fclose($arqUsuarios);
    fclose($arqNovo);

    unlink("Usuarios.txt");
    rename("Usuarios_novo.txt", "Usuarios.txt");
    $msg = "Exclusao bem sucedida";
    echo $msg;
}
?>