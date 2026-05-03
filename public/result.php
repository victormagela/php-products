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

            ?>
                <div class="container">
                    <p>Produto: <?= htmlspecialchars($product->getName()) ?>, registrado com sucesso! Preço: R$<?= $product->getUnitPrice() ?></p>

                    <?php if ($product->getQuantity() < 5 ) { ?>
                            <p class="danger">Alerta vermelho! Produto com estoque crítico! Estoque: <?= $product->getQuantity() ?></p>
                        <?php } else if ($product->getQuantity() < 10) { ?>
                            <p class="warning">Alerta! Produto com estoque baixo! Estoque: <?= $product->getQuantity() ?></p>
                        <?php } else { ?>
                            <p class="healthy">Estoque saudável! Estoque: <?= $product->getQuantity() ?></p>
                        <?php } ?>

                    <a class="back-btn" href="index.php">Voltar</a>
                    
                </div>
            <?php

            }

        }

    ?>
    
</body>
</html>