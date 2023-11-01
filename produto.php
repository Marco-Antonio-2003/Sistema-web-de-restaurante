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
        <form action="cadastrar_produto.php" method="post">
        <h2>Escolha de item do produtos </h2>
        <br>
            <div class="form-group">
                <label for="nome_produto">Nome produto:</label>
                <input type="text" required class="form-control" id="nome_produto" name="nome_produto" placeholder="Digite o produto"  >
            </div>
            
            <div class="form-group">
                <label for="categoria_produto">Categoria:</label>
                <input type="text" required class="form-control" id="categoria_produto" name="categoria_produto" placeholder="Digite a categoria"  >
            </div>

            <div class="form-group">
                <label for="valor_produto">Valor (R$):</label>
                <input type="number" step=".01" required class="form-control" id="valor_produto" name="valor_produto" placeholder="Digite o valor do produto"  >
            </div>

            <div class="form-group">
                <label for="foto_produto">Foto do produto:</label>
                <input type="file" class="form-control" id="foto_produto" name="foto_produto"  >
            </div>

            <div class="form-group">
                <label for="info_produto">Informações Adicionais:</label>
                <textarea class="form-control" name="info_produto" id="info_produto" cols="30" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar produto</button>
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
        </form>
        <br>
        <br>
        
        <?php 
        $produtos = isset($produtos) ? $produtos : array();
        if(count($produtos)>0): ?>

                <h4>Produtos cadastrados</h4>
                <table class="table">
                <tr>
                    <th>Codigo</th>
                    <th>Foto</th>
                    <th>Nome do produto</th>
                    <th>categoria</th>
                    <th>valor</th>
                    <th>Informações Adicionais</th>
                    <th>Data e hora do cadastro</th>
                    <th></th>
                </tr>
                <?php 
                if (isset($produtos) && is_array($produtos)) {
                    foreach ($produtos as $p) { ?>
                        <tr>
                            <td><?= $p['codigo'];?></td>
                            <td><?= $p['foto'];?></td>
                            <td><?= $p['nome'];?></td>
                            <td><?= $p['categoria'];?></td>
                            <td><?= $p['valor'];?></td>
                            <td><?= $p['info_adicional'];?></td>
                            <td><?= $p['data_hora'];?></td>
                            <td>
                            <form action="remover_produto.php" method="post">

                                <input type="text" name="codigo" placeholder="código do produto" data-id="<?= $p['codigo']; ?>">

                                <button class="btn btn-outline-warning btn-sn">Alterar</button>

                                <button class="btn btn-outline-warning btn-sn" onclick="removerProduto()">Remover</button>

                            </form>

                            <script>
                                function removerProduto() {
                                // Obter o id do produto a ser removido
                                const id = document.querySelector("input[name='codigo']").dataset.id;

                                // Enviar uma solicitação AJAX para remover o produto
                                fetch(`/remover_produto.php?id=${id}`, {
                                    method: "POST",
                                })
                                    .then((response) => {
                                    // Verificar se a solicitação foi bem-sucedida
                                    if (response.ok) {
                                        // Remover o produto da tabela
                                        const row = document.querySelector(`tr[data-id="${id}"]`);
                                        row.remove();
                                    }
                                    })
                                    .catch((error) => {
                                    // Exibir uma mensagem de erro
                                    console.error(error);
                                    });
                                }
                            </script>

                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "Nenhum produto encontrado";
                } ?>
                </table>
        <?php endif ?> 

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>