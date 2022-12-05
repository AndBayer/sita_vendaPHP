<?php
$pdo = new PDO('mysql::host=localhost; dbname=db_loja', 'root', '');

if (isset($_POST['cadastrarCat'])) {
  $categoria = $_POST['categoria'];

  $sql = $pdo->prepare("SELECT * FROM tb_categoria");
  $sql->execute();

  $tb_categoria = $sql->fetchAll();

  foreach ($tb_categoria as $key => $value) {
    if ($value['categoria'] == $categoria) {

?>
      <p class="alert-warning">Categoria não adicionada. <?= $categoria; ?> já existe!</p>
    <?php
      $categoria = "existente";
      break;
    }
  }
  if ($categoria != 'existente') {
    $sql = $pdo->prepare("INSERT INTO tb_categoria VALUES (null,?)");
    $sql->execute(array($categoria));

    ?>
    <p class="alert-success">Categoria <?= $categoria; ?> adicionada com sucesso!</p>
<?php
    header('index.php');
    unset($_POST);
  }
}

?>

<div class="modal fade" id="addCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Categoria:</label>
            <input type="text" class="form-control" id="recipient-name" name="categoria">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button name='cadastrarCat' type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>