<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-container', function (Request $request) {
    return $request->input('key');
});

Route::get('/test-provider', function (UserService $userService) {
    return $userService->listUsers();
});

Route::get('/test-users', [UserController::class, 'index']);

Route::get('/test-facade', function (UserService $userService) {
    return Response::json($userService->listUsers());
});

// Fix parameter naming issue
Route::get('/post/{post}/comment/{comment}', function (string $post, string $comment) {
    return "Post ID: " . $post . " - Comment: " . $comment;
});

// Ensure ID is numeric
Route::get('/post/{id}', function (string $id) {
    return $id;
})->where('id', '[0-9]+');

// Catch-all search route with constraints to prevent conflicts
Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '[a-zA-Z0-9\-]+');

// Fix named route recursion issue
Route::get('/test/route', function () {
    return "This is a test route"; 
})->name('test-route');

// Middleware group for user routes
Route::middleware(['user-middleware'])->controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

// Token-related routes
Route::get('/token', fn () => view('token'));
Route::post('/token', fn (Request $request) => $request->all());

// Register RESTful resource routes for ProductController
Route::resource('products', ProductController::class);

// Define a route that returns a list of products
Route::get('/product-list', function (ProductService $productService) {
    return view('products.list', ['products' => $productService->listProducts()]);
});

// 1️⃣ `/products` - Ipakita lang ang "4 Orange Fruit"
Route::get('/products', [ProductController::class, 'index']);

// 2️⃣ `/product-list` - Ipakita lahat ng products maliban sa "4 Orange Fruit"
Route::get('/product-list', [ProductController::class, 'list']);
