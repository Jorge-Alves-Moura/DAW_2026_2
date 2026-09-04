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
    <title>Excluir Aluno</title>
</head>

<body>

    <h1>Excluir Aluno</h1>

    <p><strong>Nome:</strong> <?php echo $nome; ?></p>

    <p><strong>Matrícula:</strong> <?php echo $matricula; ?></p>

    <p><strong>Email:</strong> <?php echo $email; ?></p>

    <p>Deseja realmente excluir este aluno?</p>

    <form action="Excluir.php" method="post">

        <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">

        <button type="submit">Sim, excluir</button>

    </form>

    <br>

    <a href="listar_alunos.php">
        <button>Cancelar</button>
    </a>

</body>

</html>