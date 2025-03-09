<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // 1️⃣ `/products` - Filtered, lalabas lang ang "4 Orange Fruit"
    public function index()
    {
        $products = $this->productService->listProducts();

        // Filter para ipakita lang ang Orange
        $filteredProducts = array_filter($products, function ($product) {
            return $product['id'] == 4 && $product['name'] === 'Orange' && $product['category'] === 'Fruit';
        });

        return view('products.index', [
            'products' => $filteredProducts,
        ]);
    }

    // 2️⃣ `/product-list` - Lahat ng products except "4 Orange Fruit"
    public function list()
    {
        $products = $this->productService->listProducts();

        // I-filter para mawala ang "4 Orange Fruit"
        $filteredProducts = array_filter($products, function ($product) {
            return !($product['id'] == 4 && $product['name'] === 'Orange' && $product['category'] === 'Fruit');
        });

        return view('products.list', [
            'products' => $filteredProducts,
        ]);
    }
}
