<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $sigla = $_POST["sigla"];

            $arqDisc = fopen("disciplinas.txt", "r") or die("erro ao abrir arquivo");
            $arqNovo = fopen("disciplinas_novo.txt", "w") or die("erro ao criar arquivo");

            while(!feof($arqDisc))
            {
                $linha = fgets($arqDisc);

                if($linha == false)
                {
                    break;
                }

                $dados = explode(";", $linha);

                if($dados[1] != $sigla)
                {
                    fwrite($arqNovo, $linha);
                }
            }

            fclose($arqDisc);
            fclose($arqNovo);

            unlink("disciplinas.txt");
            rename("disciplinas_novo.txt", "disciplinas.txt");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir disciplina</title>
</head>
<body>
    <form action="ex003_excluir_disciplina.php" method="post">
        <input type="text" name="sigla" placeholder="Sigla:"><br>
        <button type="submit">Excluir</button>
    </form>
</body>
</html>