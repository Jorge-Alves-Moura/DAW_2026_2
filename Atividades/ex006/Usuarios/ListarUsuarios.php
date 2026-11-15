<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <script>
        function ListarUsuarios() {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Resposta chegou ok: " + this.responseText);
                    document.getElementById("corpoTabela").innerHTML = this.responseText;
                } else if (this.readyState < 4) {
                    console.log("Carregando: " + this.readyState);
                } else {
                    console.log("Requisição falhou: " + this.status);
                }
            };

            xmlhttp.open("GET", "ListarUsuarios.php", true);
            xmlhttp.send();
            console.log("Solicitei lista");
        }

        function ExcluirDaLista(matricula) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Resposta chegou ok: " + this.responseText);
                    document.getElementById("resultado").innerHTML =
                        "Resultado: " + this.responseText;
                    ListarUsuarios();
                } else if (this.readyState < 4) {
                    console.log("Carregando: " + this.readyState);
                } else {
                    console.log("Requisição falhou: " + this.status);
                }
            };

            xmlhttp.open(
                "GET",
                "ExcluirUsuario.php?matricula=" + encodeURIComponent(matricula),
                true
            );
            xmlhttp.send();
        }
    </script>
</head>

<body onload="ListarUsuarios()">
    <h1>Lista de Alunos</h1>
    <p>
        <a href="IncluirUsuario.html"><button>Novo Usuário</button></a>
        <a href="ExcluirUsuario.html"><button>Excluir por Matrícula</button></a>
    </p>
    <table border="1">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="corpoTabela"></tbody>
    </table>
    <h3 id="resultado">Resultado:</h3>
</body>

</html>