<?php 

$nome = filter_input(INPUT_POST, 'nome_produto');
$qtd = filter_input(INPUT_POST, 'qtd_produto');
$obs = filter_input(INPUT_POST, 'obs_produto');
$preco = filter_input(INPUT_POST, 'preco_produto');

try {
    include("conexao_bd.php");
    $sql = "INSERT INTO item_pedido (cod_usuario, nome_produto, observacao, preco_und, quantidade) VALUES (?,?,?,?,?)";
    $stmt= $conn->prepare($sql);

    // Verifique se os campos estão vazios
    if(empty($nome) || empty($obs) || empty($preco) || empty($qtd)) {
        $resultado["msg"] = "Por favor, preencha todos os campos.";
        $resultado ["cod"] = 0;
    } else {
        $stmt->execute([null, $nome, $obs, $preco, $qtd]);
        $resultado["msg"] = "Item inserido";
        $resultado ["cod"] = 1;
    }
} catch(PDOException $e) {
    $resultado['msg'] = "Inserção no bd: falhou: " . $e->getMessage();
    $resultado['cod'] = 0;
}
$conn = null;

include("pedido.php");


?>
