<?php 
    $pdo = new PDO('mysql::host=localhost; dbname=db_loja','root','');

    if(isset($_POST['cadastrarMarca'])){
      $marca = $_POST['marca'];

      $sql = $pdo->prepare("SELECT * FROM tb_marca");
      $sql->execute();

      $tb_marca = $sql->fetchAll();

      foreach ($tb_marca as $key => $value){
          if($value['marca'] == $marca or $value['marca']==''){
            
            ?>
              <p class="alert-warning">Marca não adicionada. <?= $marca; ?> já existe!</p>
            <?php
            $marca = "existente";
            break;
          }
      }
      if($marca != 'existente'){
          $sql = $pdo->prepare("INSERT INTO tb_marca VALUES (null,?)");
          $sql->execute(array($marca));

          ?>
              <p class="alert-success">Marca <?= $marca; ?> adicionada com sucesso!</p>
          <?php
          unset( $_POST );
      }
    }

?>

<div class="modal fade" id="addMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
          <div class="modal-body">     
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Marca:</label>
                <input type="text" class="form-control" id="recipient-name" name="marca">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button name='cadastrarMarca'type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
      </form>
    </div>
  </div>
</div>