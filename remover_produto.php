<?php

// Criar conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "restaurante_bd");

// Verificar a conexão
if ($conn->connect_error) {
  die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// ID do produto a ser removido
$codigo = $_POST['codigo'];

// Remover o produto da tabela
$sql = "DELETE FROM produto WHERE codigo=$codigo";

if ($conn->query($sql) === TRUE) {
  // Exibir uma mensagem de sucesso
  echo "Produto removido com sucesso!";
} else {
  // Exibir uma mensagem de erro
  echo "Erro ao remover o produto: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();

include("cadastrar_produto.php");

?>
