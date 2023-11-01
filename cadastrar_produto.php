<?php 

    $nome = filter_input(INPUT_POST, 'nome_produto');
    $categoria = filter_input(INPUT_POST, 'categoria_produto');
    $valor = filter_input(INPUT_POST, 'valor_produto');
    $foto = filter_input(INPUT_POST, 'foto_produto');
    $info = filter_input(INPUT_POST, 'info_produto');


 
    try {
        include("conexao_bd.php");
        $sql = "INSERT INTO produto (nome, categoria, valor, foto, info_adicional) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);

        // Verifica se os campos estão vazios
        if(empty($nome) || empty($categoria) || empty($valor) || empty($foto) || empty($info)) {
            $resultado["msg"] = "Por favor, preencha todos os campos.";
            $resultado ["cod"] = 2;
        } else {
            $stmt->execute([$nome, $categoria, $valor, $foto, $info]);
            $resultado["msg"] = "Produto inserido";
            $resultado ["cod"] = 1;
 
        }
    }catch(PDOException $e) {
        $resultado['msg'] = "Erro ao inserir produto no bando de dados: " . $e->getMessage();
        $resultado['cod'] = 0;
        $conn = null;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM produto");
        $stmt->execute();
        $produtos  = $stmt->fetchAll();

        

    } catch(PDOException $e) {
        $resultado['msg'] = "Erro ao selecionar produto no banco de dados: " . $e->getMessage();
        $resultado['cod'] = 0;
        
    }
   
    $conn = null;

    include("produto.php");

?>
