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

// Consulta para selecionar o cliente pelo ID
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
  <title>Detalhes do Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-4">
    <h1>Detalhes do Cliente</h1>
    <ul class="list-group">
      <li class="list-group-item"><strong>Id:</strong> <?php echo $cliente['id']; ?></li>
      <li class="list-group-item"><strong>Nome:</strong> <?php echo $cliente['nome']; ?></li>
      <li class="list-group-item"><strong>Telefone:</strong> <?php echo $cliente['telefone']; ?></li>
      <li class="list-group-item"><strong>Endereço:</strong> <?php echo $cliente['endereco']; ?></li>
      <li class="list-group-item"><strong>Sexo:</strong> <?php echo $cliente['sexo']; ?></li>
    </ul>
    <a href="lista.php" class="btn btn-secondary mt-3">Voltar à lista de clientes</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>