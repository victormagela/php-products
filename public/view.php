<?php
    require_once '../src/Classes/Dbh.php';
    require_once '../src/Classes/Product.php';
    require_once '../src/Classes/ProductRepository.php';

    $repo = new ProductRepository(Dbh::getConnection());
    $products = $repo->getAll();

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
        <?php if($products): ?>
            <table>
                <caption>
                    <p class="healthy">Verde - Estoque Saudável</p>
                    <p class="warning">Laranja - Estoque baixo</p>
                    <p class="danger">Vermelho - Estoque crítico</p>

                </caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                    
                    </tr>
                
                </thead>
                <tbody>
                    <?php foreach($products as $product): ?>
                        <?php 
                            $formattedPrice = number_format(htmlspecialchars($product->getunitPrice()), 2);
                            $quantity = htmlspecialchars($product->getQuantity());
                            $quantityClass = (function () use ($quantity) {
                                if ($quantity >= 10) return "healthy";
                                else if ($quantity >= 5) return "warning";
                                else return "danger";

                            })();

                        ?>
                        <tr>
                            <td><?= $product->getId() ?></td>
                            <td><?=  htmlspecialchars($product->getName()) ?></td>
                            <td><?= $formattedPrice ?></td>
                            <td><span class="<?= $quantityClass ?>"><?= $quantity ?></span></td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
                
            </table>

        <?php else:
            echo "Nenhum produto salvo.";
        endif; ?>
        
    </div>
    <a href="./index.php" class="link-btn">Voltar</a>
    
</body>
</html>