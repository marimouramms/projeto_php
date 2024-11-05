<?php
session_start();

// Se já estiver logado, redireciona para a página inicial
if (isset($_SESSION['usuario_id'])) {
    header("Location: home.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email existe no banco
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Usuário encontrado e senha válida
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: home.php"); // Redireciona para a página inicial
            exit();
        } else {
            $erro = "Senha inválida!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    
    <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>

    <form method="POST" action="login.php">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
