<?php

// Define a função seleciona_produtos_habilitados()
function seleciona_produtos_habilitados() {

    // Inclui o arquivo de conexão com o banco de dados
    include("conexao_bd.php");

    // Prepara a instrução SQL para selecionar todos os produtos habilitados
    $sql = "SELECT * FROM produto WHERE situacao = 'Habilitado'";

    // Cria um objeto PDOStatement
    $stmt = $conn->prepare($sql);

    // Executa a instrução SQL
    $stmt->execute();

    // Obtém os resultados da consulta
    $produtos = $stmt->fetchAll();

    // Retorna os produtos habilitados
    return $produtos;
}

