<?php
$pdo = new PDO('mysql::host=localhost; dbname=db_loja', 'root', '');



if (isset($_POST['cadastrarProd'])) {
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];

    $sql = $pdo->prepare("SELECT * FROM tb_produtos");
    $sql->execute();
    $tb_produto = $sql->fetchAll();
    foreach ($tb_produto as $key => $value) {
        if ($value['nome'] == $produto) {
        ?>
            <p class="alert-warning">Produto não adicionado. <?= $produto; ?> já existe!</p>
        <?php
            $produto = "existente";
            break;
        }
    }
    if ($produto != 'existente') {

        if(isset($_FILES['imagem'])){
            $extensao = explode('.',($_FILES['imagem']['name']));
            $extensao = strtolower(end($extensao));
            $novo_nome = md5(time()).'.'.$extensao;
            $diretorio = ("C:\\xampp\\htdocs\\site_venda\\produto\\imgProdutos\\");
        
            move_uploaded_file(($_FILES['imagem']['tmp_name']), $diretorio.$novo_nome);
        }
        
        
        $sql = $pdo->prepare("INSERT INTO tb_produtos VALUES (null,?,?,?,?,?,?)");
        $sql->execute(array($produto, $quantidade, $valor, $categoria, $marca, $novo_nome));
        ?>
            <p class="alert-success">Produto <?= $produto; ?> adicionada com sucesso!</p>
        <?php
        unset($_POST);
    }
}

?>

<div class="modal fade" id="addproduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- Botao Close -->
                    <span aria-hidden="true">&times;</span>
                </button><!-- Botao Close -->
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" id="recipient-name" name="produto">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Quantidade:</label>
                                <input type="number" class="form-control" id="recipient-name" name="quantidade">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Valor:</label>
                                <input type="float" class="form-control" id="recipient-name" name="valor">
                            </div>
                            <div class="form-group">
                                <label for="categoria" class="col-form-label">Categoria</label>
                                <select name='categoria' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <?php
                                    $sql = $pdo->prepare("SELECT * FROM tb_categoria");
                                    $sql->execute();
                                    $tb_categoria = $sql->fetchAll();
                                    foreach ($tb_categoria as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['categoria'] ?></option>
                                    <?php  }  ?>
                                </select>
                                <?php echo '  ' ?>
                                <label for="marca" class="col-form-label">Marca</label>
                                <select name='marca' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <?php
                                    $sql = $pdo->prepare("SELECT * FROM tb_marca");
                                    $sql->execute();
                                    $tb_marca = $sql->fetchAll();
                                    foreach ($tb_marca as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['marca'] ?></option>
                                    <?php  }  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="imagem" class="col-form-label">Imagem:</label>
                                <input type="file" accept="image/*" id="imagem" required name="imagem" class="btn btn-outline-secondary">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button name='cadastrarProd' type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>