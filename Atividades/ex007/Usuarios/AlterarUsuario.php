<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["matricula"])) {
    header("Content-Type: application/json; charset=utf-8");
    $matricula = trim($_GET["matricula"]);

    $stmt = $pdo->prepare("SELECT matricula, nome, email FROM usuarios WHERE matricula = ?");
    $stmt->execute([$matricula]);
    $dados = $stmt->fetch();

    if ($dados) {
        echo json_encode([
            "encontrado" => true,
            "matricula" => $dados["matricula"],
            "nome" => $dados["nome"],
            "email" => $dados["email"]
        ]);
    } else {
        echo json_encode([
            "encontrado" => false,
            "matricula" => $matricula,
            "nome" => "",
            "email" => ""
        ]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = trim($_POST["matricula"] ?? "");
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");

    try {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE matricula = ?");
        $stmt->execute([$nome, $email, $matricula]);

        echo "Alteração bem sucedida";
    } catch (PDOException $e) {
        echo "Erro ao alterar usuário: " . $e->getMessage();
    }
}