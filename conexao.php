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

$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$endereco = $_POST["endereco"];
$sexo = $_POST["sexo"];

$sql = "INSERT INTO clientes (nome, telefone, endereco,sexo)
VALUES ('$nome', '$telefone', '$endereco ','$sexo')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

echo '<script>setTimeout(function(){ window.location.href = "lista.php"; }, 1000);</script>';



$conn->close();
?>