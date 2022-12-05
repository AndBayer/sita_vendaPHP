<?php
    $sql = $pdo->prepare("SELECT * FROM tb_categoria");
    $sql->execute();

    $categoria = $sql->fetchAll();
    if($categoria != TRUE){ ?>
        <p class="alert-warning">NÃO EXISTEM CATEGORIAS PARA SEREM EXIBIDAS</p>
        <?php }
    
    if(isset($_POST['editarCat'])){
        include('editar_categorias.php');
        
    }

    if(isset($_POST['excluirCat'])){
      try{
        $sql = $pdo->prepare("DELETE FROM tb_categoria WHERE tb_categoria.id = ?");
        $sql->execute(array($_POST['excluirCat']));
        header('Refresh:0');
        ?>
        <p class="alert-success">Categoria excluida com sucesso</p>
        <?php
      } catch(Exception) {
        ?>
        <p class="alert-danger">Não foi possível excluir essa categoria</p>
        <?php
      }
      
      
  }
?>


<div class="modal fade" id="editarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Categoria</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <?php
           

            foreach ($categoria as $key => $value){
        ?>
        <tbody>
            <tr>
              <form method="post" id='<?php $value['id'] ?>'>
                <th scope="row"><?php echo $value['id'] ?> </th>
                <td> <?php echo $value['categoria'] ?> </td>
                <td><button name="excluirCat" type="submit" class="btn btn-danger btn-sm" value='<?php echo $value['id'] ?>' >Excluir</button>
              </form>
          </td>
            </tr>


        <?php } ?>


        </tbody>

        </table>
    </div>
  </div>
</div>