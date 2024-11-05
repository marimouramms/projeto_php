<?php require 'home.php' ?>  
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtém o ID do cliente da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verifica se o formulário foi enviado para atualizar o cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST["nome"]);
    $telefone = $conn->real_escape_string($_POST["telefone"]);
    $endereco = $conn->real_escape_string($_POST["endereco"]);
    $sexo = $conn->real_escape_string($_POST["sexo"]);

    // Atualiza o cliente no banco de dados
    $sql = "UPDATE clientes SET nome='$nome', telefone='$telefone', endereco='$endereco', sexo='$sexo' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente atualizado com sucesso!";
        echo '<script>setTimeout(function(){ window.location.href = "lista.php"; }, 1000);</script>';

    } else {
        echo "Erro ao atualizar cliente: " . $conn->error;
    }
}

// Busca os dados do cliente atual para exibir no formulário
$sql = "SELECT * FROM clientes WHERE id = $id";
$result = $conn->query($sql);

// Verifica se o cliente foi encontrado
if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
} else {
    echo "Cliente não encontrado!";
    exit;
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atualizar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-4">
    <h1>Atualizar Cliente</h1>
    <form action="atualizar.php?id=<?php echo $id; ?>" method="POST">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars($cliente['endereco']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="sexo" class="form-label">Sexo</label>
        <select class="form-control" id="sexo" name="sexo" required>
          <option value="Masculino" <?php if ($cliente['sexo'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
          <option value="Feminino" <?php if ($cliente['sexo'] == 'Feminino') echo 'selected'; ?>>Feminino</option>
          <option value="Outro" <?php if ($cliente['sexo'] == 'Outro') echo 'selected'; ?>>Outro</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Atualizar</button>
      <a href="lista.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>