<?php

namespace App\Services;

class ProductService {
    protected array $products;

    public function __construct() {
        $this->products = [
            ['id' => 1, 'name' => 'Apple', 'category' => 'Fruit'],
            ['id' => 2, 'name' => 'Broccoli', 'category' => 'Vegetable'],
            ['id' => 3, 'name' => 'Sardines', 'category' => 'Fish'],
            ['id' => 4, 'name' => 'Orange', 'category' => 'Fruit'],
        ];
    }

    public function listProducts(): array {
        return $this->products;
    }

    public function insert(array $product): bool {
        if (!isset($product['id'], $product['name'], $product['category'])) {
            return false; // Reject invalid data
        }

        $this->products[] = $product;
        return true;
    }
}
