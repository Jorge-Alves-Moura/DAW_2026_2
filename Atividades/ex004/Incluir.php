<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $email = $_POST["email"];

    if (!file_exists("Alunos.txt")) {
        $arqDisc = fopen("Alunos.txt", "w") or die("erro ao criar arquivo");
        $linha = "nome;matricula;email\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
    }
    $arqDisc = fopen("Alunos.txt", "a") or die("erro ao criar arquivo");
    $linha = $nome . ";" . $matricula . ";" . $email . "\n";
    fwrite($arqDisc, $linha);
    fclose($arqDisc);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir</title>
</head>

<body>
    <form action="Incluir.php" method="post">
        <input type="text" name="nome" placeholder="Nome:"><br>
        <input type="text" name="matricula" placeholder="Matricula:"><br>
        <input type="text" name="email" placeholder="Email:"><br>
        <button type="submit">Incluir</button>
    </form>
</body>

</html>