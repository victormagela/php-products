<?php
    require_once '../src/Classes/Dbh.php';
    require_once '../src/Classes/Product.php';
    require_once '../src/Classes/ProductRepository.php';

    $repo = new ProductRepository(Dbh::getConnection());

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
                    $rows = array_map(function ($product) {
                        $formattedPrice = number_format($product->getunitPrice(), 2);
                        $quantity = $product->getQuantity();
                        $quantityClass = (function () use ($quantity) {
                            if ($quantity >= 10) return "healthy";
                            else if ($quantity >= 5) return "warning";
                            else return "danger";

                        })();

                        return "
                            <tr>
                                <td>{$product->getName()}</td>
                                <td>{$formattedPrice}</td>
                                <td><span class=$quantityClass>$quantity</span></td>
                            </tr>
                        ";

                    }, $repo->getAll());

                    foreach ($rows as $row) {
                        echo $row;
                        
                    }
                
                ?>

            </tbody>
            
        </table>
        
    </div>
    <a href="./index.php" class="back-btn">Voltar</a>
    
</body>
</html>