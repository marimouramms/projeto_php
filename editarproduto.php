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

    // Consulta para buscar as informações do produto
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se o produto for encontrado, carrega os dados
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado!";
        exit();
    }
} else {
    echo "ID do produto não fornecido!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];

    // Atualiza o produto no banco de dados
    $sql = "UPDATE produtos SET nome = ?, quantidade = ?, valor = ?, descricao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidsi", $nome, $quantidade, $valor, $descricao, $id);
    
    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
        echo '<script>setTimeout(function(){ window.location.href = "lista_produtos.php"; }, 1000);</script>';
    } else {
        echo "Erro ao atualizar produto: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>
    <form method="post" action="editar_produto.php?id=<?php echo $produto['id']; ?>">
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
        <br>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required>
        <br>
        <label for="valor">Valor:</label>
        <input type="number" name="valor" value="<?php echo $produto['valor']; ?>" required>
        <br>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
        <br>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
