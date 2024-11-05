<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "produtos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtém o ID do cliente da URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta para obter os dados do cliente
    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o cliente existe
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "Cliente não encontrado.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID de cliente não fornecido.";
    exit();
}

$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h3>Editar informações do cliente</h3>
      <form method="post" action="atualizar.php">

        <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $cliente['nome']; ?>">
        </div>

        <div class="mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="phone" name="telefone" class="form-control" id="telefone" value="<?php echo $cliente['telefone']; ?>">
        </div>

        <div class="mb-3">
          <label for="endereco" class="form-label">Endereço</label>
          <input type="text" name="endereco" class="form-control" id="endereco" value="<?php echo $cliente['endereco']; ?>">
        </div>

        <div class="mb-3">
          <label for="sexo" class="form-label">Sexo</label>
          <select class="form-select" name="sexo" id="sexo">
            <option value="masculino" <?php echo $cliente['sexo'] == 'masculino' ? 'selected' : ''; ?>>Masculino</option>
            <option value="femenino" <?php echo $cliente['sexo'] == 'femenino' ? 'selected' : ''; ?>>Feminino</option>
            <option value="outros" <?php echo $cliente['sexo'] == 'outros' ? 'selected' : ''; ?>>Outros</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>