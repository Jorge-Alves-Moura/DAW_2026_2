<?php

$arqAlunos = fopen("Alunos.txt", "r") or die("Erro ao abrir arquivo");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
</head>

<body>

    <h1>Lista de Alunos</h1>

    <table border="1">

        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>

        <?php

        while (!feof($arqAlunos)) {
            $linha = fgets($arqAlunos);

            if ($linha == false) {
                break;
            }

            $dados = explode(";", $linha);

            // Ignora o cabeçalho
            if ($dados[0] == "nome") {
                continue;
            }

            $nome = $dados[0];
            $matricula = $dados[1];
            $email = trim($dados[2]);

        ?>

            <tr>
                <td><?php echo $matricula; ?></td>
                <td><?php echo $nome; ?></td>
                <td><?php echo $email; ?></td>

                <td>
                    <a href="mostrar_alterar.php?matricula=<?php echo $matricula; ?>">
                        <button>Alterar</button>
                    </a>

                    <a href="mostrar_excluir.php?matricula=<?php echo $matricula; ?>">
                        <button>Excluir</button>
                    </a>
                </td>
            </tr>

        <?php
        }

        fclose($arqAlunos);

        ?>

    </table>

</body>

</html>