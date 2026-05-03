<?php

class Product {
    private string $name;
    private float $unit_price;
    private int $qty;

    public function __construct(string $name, float $unit_price, int $qty)
    {
        $this->name = $name;
        $this->unit_price = $unit_price;
        $this->qty = $qty;

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