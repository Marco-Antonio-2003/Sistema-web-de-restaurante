<?php 
    try {
        include("conexao_bd.php");
    
        $consulta = $conn-> prepare("SELECT * FROM produto WHERE situacao = 'HABILITADO'");
        $consulta->execute();

        $produtos = $consulta-> fetchAll();

    }catch(PDOException $e) {
        $resultado['msg'] = "Erro ao selecionar produtos do banco de dados" . $e->getMessage();
        $resultado["cod"] = 0;
        $resultado["style"] = "alert=danger";
    }
    
    $conn = null;
    include("produto.php");
?>