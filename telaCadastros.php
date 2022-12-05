<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <?php
    include('header.php');
    include('categoria/cadastrar_categoria.php');
    include('categoria/categorias.php');
    include('marca/marca.php');
    include('marca/cadastrar_marca.php');
    #include('produto/produto.php');
    include('produto/cadastrar_produto.php');
    ?>
    <section>
        <!--Cadastrar Produto -->
        <div class="card-deck cadProd">
            <div class="card">
                <img class="card-img-top" src="img/categorias_de_carros.jpg" alt="Card image cap" height="250">
                <div class="card-body">
                    <h3 class="card-title">Categorias</h3>
                    <p class="card-text">Adicione ou visualize as categorias de veículos vendidos na loja</p>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoria">Adicionar</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarCategoria">Categorias</button>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/produto_carros.jpg" alt="Card image cap" height="250">
                <div class="card-body">
                    <h3 class="card-title">Produtos</h3>
                    <p class="card-text">Adicione ou atualize os produtos vendidos na loja</p>
                </div>
                <div class="card-footer text-center"> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproduto">Adicionar</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarProduto">Produtos</button>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/marcas_de_carros.png" alt="Card image cap" height="250">
                <div class="card-body">
                    <h3 class="card-title">Marcas</h3>
                    <p class="card-text">Adicione ou visualize as marcas de veículos vendidos na loja</p>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMarca">Adicionar</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarMarca">Marcas</button>
                </div>
            </div>
        </div>
    </section>

</body>

</html>