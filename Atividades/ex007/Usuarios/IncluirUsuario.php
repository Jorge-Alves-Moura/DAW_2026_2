<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = trim($_POST["matricula"] ?? "");
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (matricula, nome, email) VALUES (?, ?, ?)");
        $stmt->execute([$matricula, $nome, $email]);

        echo "Inclusão bem sucedida!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Erro: Já existe um usuário cadastrado com essa matrícula!";
        } else {
            echo "Erro ao incluir usuário: " . $e->getMessage();
        }
    }
}