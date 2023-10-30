<?php 

$cod_produto = filter_input(INPUT_POST, 'cod_produto');

try {
    include("conexao_bd.php");

    if (empty($cod_produto)) {
        $resultado["msg"] = "Por favor, forneça um código de produto válido.";
        $resultado["cod"] = 2;
    } else {
        $sql = "DELETE FROM produto WHERE cod_produto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cod_produto]);
        $resultado["msg"] = "Item removido com sucesso.";
        $resultado["cod"] = 1;
    }
} catch (PDOException $e) {
    $resultado['msg'] = "Erro ao remover item: " . $e->getMessage();
    $resultado['cod'] = 0;
}

$conn = null;
include("produto.php");

?>