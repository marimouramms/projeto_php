<?php
session_start();

// Se já estiver logado, redireciona para a página inicial
if (isset($_SESSION['usuario_id'])) {
    header("Location: lista_produtos.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário de registro foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    // Valida os dados
    if (empty($usuario) || empty($senha) || empty($email)) {
        $erro = "Todos os campos são obrigatórios!";
    } else {
        // Previne SQL Injection
        $usuario = $conn->real_escape_string($usuario);
        $senha = $conn->real_escape_string($senha);
        $email = $conn->real_escape_string($email);

        // Verifica se o usuário já existe no banco de dados
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $erro = "E-mail já cadastrado!";
        } else {
            // Insere o novo usuário no banco de dados
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);  // Armazenando a senha de forma segura
            $sql = "INSERT INTO usuarios (usuario, senha, email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $usuario, $senhaHash, $email);

            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
                echo '<script>setTimeout(function(){ window.location.href = "login.php"; }, 1000);</script>';
            } else {
                $erro = "Erro ao cadastrar usuário: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
</head>
<body>
    <h2>Registrar</h2>

    <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>

    <form method="POST" action="registrar.php">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Registrar</button>
    </form>

    <p>Já tem uma conta? <a href="login.php">Entrar</a></p>

</body>
</html>
