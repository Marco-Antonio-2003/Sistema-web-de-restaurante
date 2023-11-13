<?php 

$produtos = $_POST('nome_produto');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurnate_bd";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//$nome = "nome_produto";
//$id = "codigo";

$alterar = "UPDATE produto SET nome = '$produtos' WHERE codigo = '$codigo'";

$result = mysqli_query($conn, $alterar);

if ($result) {
    echo "Produto atualizado com sucesso!";
} else {
    echo "Erro ao atualizar produto: " . mysqli_error($conn);
}


mysqli_close($conn);


?>