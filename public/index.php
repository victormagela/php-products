<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <div class="container">
        <h1>Cadastre seu produto</h1>
    
        <form action="./index.php" method="post">
            <div class="form-field">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" required>
            </div>
            
            <div class="form-field">
                <label for="unit-price">Preço unitário:</label>
                <input type="number" name="unit-price" id="unit-price" step="0.01" required>
            </div>
            
            <div class="form-field">
                <label for="qty">Quantidade:</label>
                <input type="number" name="qty" id="qty" required>
            </div>
    
            <div class="btns">
                <a href="./view.php" class="link-btn">Ver Tabela</a>
                <input type="submit" value="Cadastrar" name="register">

            </div>
        
        </form>

    </div>
    
</body>
</html>

<?php 
    require_once '../src/Classes/Product.php';
    require_once '../src/Classes/Dbh.php';
    require_once '../src/Classes/ProductRepository.php';

    $repo = new ProductRepository(Dbh::getConnection());

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            if (isset($_POST['register'])) {

                $product = Product::create($_POST['name'], $_POST['unit-price'], $_POST['qty']);
                $repo->save($product);

            }

    }

?>