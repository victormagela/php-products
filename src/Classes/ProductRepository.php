<?php

class ProductRepository {
    private PDO $db;
    private bool $tableReady;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->tableReady = $this->tableExist();

    }

    private function tableExist() : bool {
        try {
            $result = $this->db->query("
                SELECT 1 FROM products LIMIT 1;
            ");
        } catch (Exception $e) {
            return false;
        }

        return $result !== false;
    }

    private function createProductsTable() {
        $this->db->exec("
                    CREATE TABLE IF NOT EXISTS products(
                    product_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    unit_price REAL NOT NULL,
                    qty INTEGER NOT NULL
                    );
        ");

    }

    public function save(Product $product) {
        if (!$this->tableReady) {
            $this->createProductsTable();
            $this->tableReady = true;
        }

        $stmt = $this->db->prepare("
            INSERT INTO products (name, unit_price, qty) VALUES (:name, :unit_price, :qty);
        ");
        $stmt->execute([':name' => $product->getName(), ':unit_price' => $product->getUnitPrice(), ':qty' => $product->getQuantity()]);

    }

    /**
    * @return Product[]
    */
    public function getAll(): array {
        if (!$this->tableReady) return [];

        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return array_map(fn($row) => Product::recreate($row['product_id'], $row['name'], $row['unit_price'], $row['qty']), $result);

    }

}