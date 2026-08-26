<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $nome = $_POST["nome"];
            $sigla = $_POST["sigla"];
            $carga = $_POST["carga"];

            if(!file_exists("disciplinas.txt"))
                {
                    $arqDisc = fopen("disciplinas.txt","w") or die("erro ao criar arquivo");
                    $linha = "nome;sigla;carga\n";
                    fwrite($arqDisc,$linha);
                    fclose($arqDisc);
                }
            $arqDisc = fopen("disciplinas.txt","a") or die("erro ao criar arquivo");
            $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
            fwrite($arqDisc,$linha);
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
    <form action="incluir_disciplina.php" method="post">
        <input type="text" name="nome" placeholder="Nome:"><br>
        <input type="text" name="sigla" placeholder="Sigla:"><br>
        <input type="text" name="carga" placeholder="Carga:"><br>
        <button type="submit">Incluir</button>
    </form>
</body>
</html>