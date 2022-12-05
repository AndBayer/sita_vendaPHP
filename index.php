<?php
$pdo = new PDO('mysql::host=localhost; dbname=db_loja', 'root', '');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Vendas</title>
</head>

<body>
    <?php
    include('header.php')
    ?>


    <section class="">
        <!-- Exibindo produtos cadastrados -->

        <?php
        $sql = $pdo->prepare("SELECT * FROM tb_produtos");
        $sql->execute();

        $produtos = $sql->fetchAll();
        if ($produtos != TRUE) { ?>
            <p class="alert-warning">NÃO EXISTEM PRODUTOS PARA SEREM EXIBIDOS</p>
        <?php }

        foreach ($produtos as $key => $value) {
            $img = ("produto/imgProdutos/".$value['imagem']);
        ?>
            <div class="cartao">
                <div class="">
                    <div class="card">
                        <img class="card-img-top imgCartao" src="<?= $img ?>">
                        <div class="card-body text-center">
                            <h3 class="card-title"><?php echo $value['nome'] ?></h3>
                            <p class="card-text">Valor: R$<?php echo $value['valor'] ?></p>
                            <p class="card-text">Estoque: <?php echo $value['quantidade'] ?></p>
                            <div class="card-footer text-center">
                                <a href="#" class="btn btn-sm btn-success float-right">Comprar</a>
                                <a href="#" class="btn btn-sm btn-primary float-left ">Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </section>

</body>

</html>