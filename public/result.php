<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Produtos</title>
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            require_once './Classes/Product.php';
        
            if (isset($_POST['register'])) {
                $name = $_POST['name'];
                $unitPrice = $_POST['unit-price'];
                $qty = $_POST['qty'];

                $product = new Product($name, $unitPrice, $qty);
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