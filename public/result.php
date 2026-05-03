<?php
    function getQuantityClass(int $quantity): string {
        if ($quantity >= 10) {
            return "healthy";
        } else if ($quantity >= 5) {
            return "warning";
            
        } else return "danger";

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Produtos</title>
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            if (isset($_POST['register'])) {
                require_once '../src/Classes/Product.php';
                require_once '../src/Classes/Dbh.php';
                require_once '../src/Classes/ProductRepository.php';

                $repo = new ProductRepository(Dbh::getConnection());

                $product = new Product($_POST['name'], $_POST['unit-price'], $_POST['qty']);
                $repo->save($product);
                $rows = array_map(function ($product) {
                    $formattedPrice = number_format($product->getunitPrice(), 2);
                    $quantity = $product->getQuantity();
                    $quantityClass = getQuantityClass($quantity);

                    return "
                        <tr>
                            <td>{$product->getName()}</td>
                            <td>{$formattedPrice}</td>
                            <td><span class=$quantityClass>$quantity</span></td>
                        </tr>
                    ";

                }, $repo->getAll());

            ?>
                <div class="container">
                    <table>
                        <caption>
                            <p class="healthy">Verde - Estoque Saudável</p>
                            <p class="warning">Laranja - Estoque baixo</p>
                            <p class="danger">Vermelho - Estoque crítico</p>

                        </caption>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Preço Unitário</th>
                                <th>Quantidade</th>
                            
                            </tr>
                        
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($rows as $row) {
                                    echo $row;
                                    
                                }
                            
                            ?>

                        </tbody>
                        
                    </table>
                    
                </div>
                <a href="./index.php" class="back-btn">Voltar</a>
            <?php

            }

        }

    ?>
    
</body>
</html>