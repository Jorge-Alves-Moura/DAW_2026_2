<?php

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arqProfessores = fopen("Professores.txt", "r") or die("Erro ao abrir arquivo!");
    $arqNovo = fopen("Professores_novo.txt", "w") or die("Erro ao criar!");

    while (!feof($arqProfessores)) 
    {
        $linha = fgets($arqProfessores);

        if ($linha == false) 
        {
            break;
        }

        $dados = explode(";", $linha);
        fwrite($arqNovo, $linha);
    }

    fclose($arqProfessores);
    fclose($arqNovo);

    rename("Professores_novo.txt", "Professores.txt");
    $msg = "Alteraçao bem sucedida";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="AlterarProfessor.php" method="post">
        <input type="text" name="nome" placeholder="Alterar nome:"><br>
        <input type="text" name="email" placeholder="Alterar email:"><br>
        <input type="submit">
    </form>

    <p>
    <?php
    echo($msg);
    ?>
    </p>

</body>

</html>
