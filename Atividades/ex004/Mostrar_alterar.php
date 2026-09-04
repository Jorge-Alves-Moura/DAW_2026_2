<?php

$matricula = $_GET["matricula"];

$arqAlunos = fopen("Alunos.txt", "r") or die("Erro ao abrir arquivo");

$nome = "";
$email = "";

while (!feof($arqAlunos)) {
    $linha = fgets($arqAlunos);

    if ($linha == false) {
        break;
    }

    $dados = explode(";", $linha);

    if ($dados[0] == "nome") {
        continue;
    }

    if (trim($dados[1]) == $matricula) {
        $nome = $dados[0];
        $email = trim($dados[2]);

        break;
    }
}

fclose($arqAlunos);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alterar Aluno</title>
</head>

<body>

    <h1>Alterar Aluno</h1>

    <form action="Alterar.php" method="post">

        <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>">
        <br><br>

        <label>Matrícula:</label>
        <input type="text" value="<?php echo $matricula; ?>" disabled>
        <br><br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <br><br>

        <button type="submit">Alterar</button>

    </form>

</body>

</html>