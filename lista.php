<?php require 'home.php'; ?>
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

// Filtro de busca
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM clientes WHERE nome LIKE ? LIMIT 10";  // Paginação e filtro de pesquisa
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Clientes</h1>
        
        <form method="get" action="lista.php">
            <input type="text" name="search" placeholder="Buscar Cliente" value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Buscar</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nome"]; ?></td>
                            <td><?php echo $row["telefone"]; ?></td>
                            <td><?php echo $row["sexo"]; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="detalhar.php?id=<?php echo $row['id']; ?>" role="button">Detalhar</a>
                                <a class="btn btn-success btn-sm" href="atualizar.php?id=<?php echo $row['id']; ?>" role="button">Atualizar</a>
                                <a class="btn btn-danger btn-sm" href="excluir.php?id=<?php echo $row['id']; ?>" role="button" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                            </td>
                        </tr>
                    <?php } 
                } else { ?>
                    <tr><td colspan="5" class="text-center">Nenhum cliente encontrado</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

<?php $conn->close(); ?>
