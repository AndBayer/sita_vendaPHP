<?php
$pdo = new PDO('mysql::host=localhost; dbname=db_loja', 'root', '');
$sql = $pdo->prepare("SELECT * FROM tb_produto");
$sql->execute();
$produto = $sql->fetchAll();

?>
<!doctype html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <div class="center">
        <div class="logo left">Logomarca</div>
        <nav class="desktop right">
            <ul class="menu">
                <li><a type="button" class="btn btn-danger" href="../telaCadastros.php">VOLTAR</a></li>

            </ul>
        </nav>
        <div class="clear"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
</header>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <?php
        foreach ($produto as $key => $value) {
        ?>
            <tbody>
                <tr>
                    <form method="post" id='<?php $value['id'] ?>'>
                        <th scope="row"><?php echo $value['id'] ?> </th>
                        <td> <?php echo $value['nome'] ?> </td>
                        <td> <?php echo $value['quantidade'] ?> </td>
                        <td> <?php echo $value['valor'] ?> </td>
                        <td> <?php echo $value['categoria'] ?> </td>
                        <td> <?php echo $value['marca'] ?> </td>


                        <td><button name="" type="submit" class="btn btn-danger btn-sm" value='<?php echo $value['id'] ?>'>Excluir</button>
                    </form>
                    </td>
                </tr>


            <?php } ?>

    </table>

</body>