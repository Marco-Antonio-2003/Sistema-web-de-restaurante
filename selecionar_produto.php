<?php

global $conn;
$nome_original = "";

$where_cod = "";
if(isset($_GET["cod_prod"]) && $_GET["cod_prod"] > 0) {
    $where_cod = " AND codigo =".$_POST["cod_prod"]; 
}

try{
    include("conexao_bd.php");
    $consulta = $conn->prepare("SELECT * FROM produto WHERE situacao = 'Habilitado'" . $where_cod);
    $consulta->execute();

    $produtos = $consulta->fetchAll();
}catch(PDOException $e) {
    $resultado['msg'] = "Erro ao selecionar produtos do banco: " . $e->getMessage();
    $resultado['cod'] = 0;
}

$conn = null;

if (isset($produtos["nome"])) {
    $nome_original = $produtos["nome"];
}

?>