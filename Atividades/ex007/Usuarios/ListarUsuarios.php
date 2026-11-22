<?php
require_once "../conexao.php";

$stmt = $pdo->query("SELECT matricula, nome, email FROM usuarios ORDER BY nome ASC");

while ($usuario = $stmt->fetch()) {
    $matricula = htmlspecialchars($usuario["matricula"]);
    $matriculaUrl = urlencode($usuario["matricula"]);
    $nome = htmlspecialchars($usuario["nome"]);
    $email = htmlspecialchars($usuario["email"]);

    echo "<tr>";
    echo "<td>$matricula</td>";
    echo "<td>$nome</td>";
    echo "<td>$email</td>";
    echo "<td>";
    echo "<a href='AlterarUsuario.html?matricula=$matriculaUrl'><button type='button'>Alterar</button></a> ";
    echo "<button type='button' onclick=\"ExcluirDaLista('$matricula')\">Excluir</button>";
    echo "</td>";
    echo "</tr>";
}