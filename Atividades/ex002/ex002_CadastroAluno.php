<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $matricula = $_POST["matricula"];
            $cpf = $_POST["cpf"];
            $msg = "";

            if(!file_exists("Alunos_Cadastrados.txt"))
                {
                    $arqDisc = fopen("Alunos_Cadastrados.txt", "w") or die("Erro ao criar arquivo");
                    $linha = "nome;email;matricula;cpf\n";
                    fwrite($arqDisc,$linha);
                    fclose($arqDisc);
                }

            $arqDisc = fopen("Alunos_Cadastrados.txt", "a") or die("Erro ao criar arquivo");
            $linha = $nome . ";" . $email . ";" . $matricula . ";" . $cpf . "\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Aluno cadastrado com sucesso";
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de aluno</title>
</head>

<body>
    <!-- Deve ter nome, email, matricula e cpf -->
    <h1>Adicionar aluno</h1>
    <form action="ex002_CadastroAluno.php" method="post">
        <input type="text" name="nome" placeholder="Nome"><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="text" name="matricula" placeholder="Matrícula"><br><br>
        <input type="text" name="cpf" placeholder="CPF">
        <button type="submit">Cadastrar</button>
    </form>

    <p><?php echo $msg ?></p>

</body>
</html>