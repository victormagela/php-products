<?php

class Product {
    private ?int $productId;
    private string $name;
    private float $unit_price;
    private int $qty;

    private function __construct(string $name, float $unit_price, int $qty, ?int $productId = null)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->unit_price = $unit_price;
        $this->qty = $qty;

    }

    public static function create(string $name, float $unit_price, int $qty) : Product {
        return new Product($name, $unit_price, $qty);

    }

    public static function recreate(int $productId, string $name, float $unit_price, int $qty) : Product {
        return new Product($name, $unit_price, $qty, $productId);
    }

    public function getId() : int {
        return $this->productId;
    }

    public function getName() : string {
        return $this->name;

    }

    public function getUnitPrice() : float {
        return $this->unit_price;

    }

    public function getQuantity() : int {
        return $this->qty;

    }

}