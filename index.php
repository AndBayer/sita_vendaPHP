<?php
$pdo = new PDO('mysql::host=localhost; dbname=db_loja', 'root', '');
$filtro = '';
$filtro2 = '';
$categoria = '';
$fil = '';

if (isset($_POST['filtrar'])) {
    $filtro = $_POST['filtroOpcoes'];
    $categoria = $_POST['filtroCategoria'];


    if ($filtro == 'maiorPr') {
        $filtro = ' ORDER BY valor DESC';
        $fil = 'Maior preço';
    } elseif ($filtro == 'menorPr') {
        $filtro = ' ORDER BY valor';
        $fil = 'Menor preço';
    } elseif ($filtro == 'maiorEst') {
        $filtro = ' ORDER BY quantidade DESC';
        $fil = 'Maior estoque';
    } elseif ($filtro == 'menorEst') {
        $filtro = ' ORDER BY quantidade';
        $fil = 'Menor estoque';
    }
    if ($categoria != '') {
        $filtro2 = ' WHERE categoria =' . $categoria;
    }
}
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
    include('header.php');
    ?>


    <div class="center">
        <form method="POST">
            Filtrar por:
            <select name='filtroOpcoes' class="form-select" aria-label="">
                <option value='' selected> <?= $fil ?></option>
                <option value="maiorPr">Maior preço</option>
                <option value="menorPr">Menor preço</option>
                <option value="maiorEst">Maior estoque</option>
                <option value="menorEst">Menor estoque</option>
            </select>
            Categoria:
            <select name='filtroCategoria' class="form-select" aria-label="" id="idmerda">
                <option value='' selected><?= $categoria ?></option>
                <?php
                $sql = $pdo->prepare("SELECT * FROM tb_categoria");
                $sql->execute();
                $tb_categoria = $sql->fetchAll();
                foreach ($tb_categoria as $key => $value) {
                ?>
                    <option select value="<?php echo $value['id'] ?>"><?php echo $value['categoria'] ?></option>
                <?php  } ?>
            </select>

            <button id='#botao' name='filtrar' type="submit" class="btn btn-outline-secondary">Filtrar</button>

    </div>
    </form>
    <br>
    <section class="">

        <!-- Exibindo produtos cadastrados -->

        <?php



        $sql = $pdo->prepare("SELECT * FROM tb_produtos" . $filtro2 . $filtro);
        $sql->execute();

        $produtos = $sql->fetchAll();
        if ($produtos != TRUE) { ?>
            <p class="alert-warning">NÃO EXISTEM PRODUTOS PARA SEREM EXIBIDOS</p>
        <?php }

        foreach ($produtos as $key => $value) {
            $img = ("produto/imgProdutos/" . $value['imagem']);
            $valor = $value['valor']

        ?>
            <script type="text/javascript">
                var valor = <?= $valor ?>;
                var valorFormatado = valor.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            </script>

            <?php
            $valor =  '<script>document.write(valorFormatado)</script>';

            ?>

            <div class="cartao">
                <div class="">
                    <div class="card">
                        <img class="card-img-top imgCartao" src="<?= $img ?>">
                        <div class="card-body text-center">
                            <h3 class="card-title"><?php echo $value['nome'] ?></h3>
                            <p class="card-text"><?php echo $valor ?></p>
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