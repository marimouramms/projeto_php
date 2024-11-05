<?php require 'home.php' ?>  
<?php
// Configurações de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtém o ID da URL

    // Verifica se o ID é um número
    if (is_numeric($id)) {
        // Preparar a consulta
        $sql = "DELETE FROM clientes WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id); // "i" significa que o parâmetro é um inteiro

        // Executar a consulta
        if ($stmt->execute()) {
            echo "Usuário deletado com sucesso.";
            echo '<script>setTimeout(function(){ window.location.href = "lista.php"; }, 1000);</script>';
        } else {
            echo "Erro ao deletar usuário: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "ID inválido.";
    }
} else {
    echo "Nenhum ID foi fornecido.";
}

// Fechar a conexão
$conn->close();
?>
