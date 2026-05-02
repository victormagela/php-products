<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastre seu produto</h1>

    <form action="./result.php" method="post">
        <div class="form-field">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name">
        </div>
        
        <div class="form-field">
            <label for="unit-price">Preço unitário:</label>
            <input type="number" name="unit-price" id="unit_price" step="0.01">
        </div>
        
        <div class="form-field">
            <label for="qty">Quantidade:</label>
            <input type="number" name="qty" id="qty">
        </div>

        <input type="submit" value="Cadastrar" name="register">
    
    </form>
    
</body>
</html>