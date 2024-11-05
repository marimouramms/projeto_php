<?php require 'home.php' ?>  
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

// Consulta para selecionar todos os clientes
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
      <h1>Lista de Produtos</h1>       
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            <th scope="col">Descrição</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["nome"] ?></td>
            <td><?php echo $row["telefone"] ?></td>
            <td><?php echo $row["endereco"] ?></td>
            <td><?php echo $row["sexo"] ?></td>
            <td>
              <a class="btn btn-primary btn-sm" href="detalhar.php?id=<?php echo $row['id'] ?>" role="button">Detalhar</a>
              <a class="btn btn-success btn-sm" href="atualizar.php?id=<?php echo $row['id'] ?>" role="button">Atualizar</a>    
              <a class="btn btn-danger btn-sm" href="excluir.php?id=<?php echo $row['id'] ?>" role="button" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
              <a class="btn btn-primary btn-sm" href="cadastrarProduto.php?id=<?php echo $row['id'] ?>" role="button">Cadastrar Produtos</a>
              <a class="btn btn-primary btn-sm" href="detalhar.php?id=<?php echo $row['id'] ?>" role="button">Listar Produtos</a>    
            </td>
          </tr>
          <?php    
            }
          } else {
            echo "<tr><td colspan='6' class='text-center'>Nenhum cliente encontrado</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>