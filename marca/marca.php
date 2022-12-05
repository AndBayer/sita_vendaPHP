<?php
    $sql = $pdo->prepare("SELECT * FROM tb_marca");
    $sql->execute();

    $marca = $sql->fetchAll();
    if($marca != TRUE){ ?>
        <p class="alert-warning">NÃO EXISTEM MARCAS PARA SEREM EXIBIDAS</p>
        <?php }
   
    if(isset($_POST['excluirMarca'])){
      try{
        $sql = $pdo->prepare("DELETE FROM tb_marca WHERE tb_marca.id = ?");
        $sql->execute(array($_POST['excluirMarca']));
        header('Refresh:0');
        ?>
        <p class="alert-success">Marca excluida com sucesso</p>
        <?php
      } catch(Exception) {
        ?>
        <p class="alert-danger">Não foi possível excluir essa marca</p>
        <?php
      }
      
      
  }
?>


<div class="modal fade" id="editarMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Marca</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <?php
           

            foreach ($marca as $key => $value){
        ?>
        <tbody>
            <tr>
              <form method="post" id='<?php $value['id'] ?>'>
                <th scope="row"><?php echo $value['id'] ?> </th>
                <td> <?php echo $value['marca'] ?> </td>
                <td><button name="excluirMarca" type="submit" class="btn btn-danger btn-sm" value='<?php echo $value['id'] ?>' >Excluir</button>
              </form>
          </td>
            </tr>


        <?php } ?>


        </tbody>

        </table>
    </div>
  </div>
</div>