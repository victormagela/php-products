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

                echo "Produto: {$product->getName()}, registrado com sucesso! <br>";

                if ($product->getQuantity() < 5 ) {
                    echo "Alerta vermelho! Produto com estoque crítico! Estoque: {$product->getQuantity()}";
                }
                else if ($product->getQuantity() < 10) {
                    echo "Alerta! Produto com estoque baixo! Estoque: {$product->getQuantity()}";
                }
                else {
                    echo "Estoque saudável!";
                }

            }
        }
    ?>

    <br>
    <a href="index.php">Voltar</a>
    
</body>
</html>