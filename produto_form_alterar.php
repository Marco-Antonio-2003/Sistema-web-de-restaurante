<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Define o código do produto que você deseja alterar
    $codigo = $_POST["codigo"];

    // Define os novos valores para o produto a partir dos campos do formulário
    $nome = $_POST["nome_produto"];
    $categoria = $_POST["categoria_produto"];
    $valor = $_POST["valor_produto"];
    $info_adicional = $_POST["info_produto"];

    // Prepara a instrução SQL
    $stmt = $conn->prepare("UPDATE produto SET nome = :nome, categoria = :categoria, valor = :valor, info_adicional = :info_adicional WHERE codigo = :codigo");

    // Executa a instrução SQL
    $stmt->execute([':nome' => $nome, ':categoria' => $categoria, ':valor' => $valor, ':info_adicional' => $info_adicional, ':codigo' => $codigo]);
}

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Produto</title>
</head>
<body>
    <div class="container">
    

    <form method="post">

    <input type="hidden" name="codigo" value="<?php echo $codigo;?>">

    <br>

    <div class="form-group">
        <label for="nome_produto">Nome produto:</label>
        <input type="text" required class="form-control" id="nome_produto" name="nome_produto" placeholder="Digite o produto"  >
    </div>

    <div class="form-group">
        <label for="categoria_produto">Categoria:</label>
        <input type="text" required   class="form-control" id="categoria_produto" name="categoria_produto" placeholder="Digite a categoria"  >
    </div>

    <div class="form-group">
        <label for="valor_produto">Valor (R$):</label>
        <input type="number" step=".01" required   class="form-control" id="valor_produto" name="valor_produto" placeholder="Digite o valor do produto"  >
    </div>

    <div class="form-group">
        <label for="foto_produto">Foto do produto:</label>
        <input type="file" class="form-control" id="foto_produto" name="foto_produto"  >
    </div>

    <div class="form-group">
        <label for="info_produto">Informações Adicionais:</label>
        <textarea class="form-control" name="info_produto"   id="info_produto" cols="30" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Alterar produto</button>

</form>
        <?php 
        if (isset($_GET["cod_prod"]) && $_GET["cod_prod"] > 0):
            $cod_prod = $_GET["cod_prod"];
            include("selecionar_produto.php");
        endif;
        ?>
   
        <?php if (isset($resultado)): ?>
                <?php if ($resultado["cod"] == 1): ?>
                    <div class="alert alert-success">
                        <?php echo $resultado['msg'];?>
                    </div>
                <?php elseif ($resultado["cod"] == 0): ?>
                    <div class="alert alert-danger"> 
                        <?php echo $resultado['msg'];?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <br>
        <br>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>