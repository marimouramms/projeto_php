<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se o ID do produto foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o produto do banco de dados
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Produto excluído com sucesso!";
        echo '<script>setTimeout(function(){ window.location.href = "lista_produtos.php"; }, 1000);</script>';
    } else {
        echo "Erro ao excluir produto: " . $stmt->error;
    }
} else {
    echo "ID do produto não fornecido!";
    exit();
}

$stmt->close();
$conn->close();
?>
