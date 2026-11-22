<?php
require_once "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["matricula"])) {
    $matricula = trim($_GET["matricula"]);

    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE matricula = ?");
        $stmt->execute([$matricula]);

        if ($stmt->rowCount() > 0) {
            echo "Exclusão bem sucedida";
        } else {
            echo "Usuário não encontrado";
        }
    } catch (PDOException $e) {
        echo "Erro ao excluir usuário: " . $e->getMessage();
    }
}