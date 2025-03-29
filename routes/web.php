<?php

use App\Services\UserService;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

// ✅ WELCOME PAGE
Route::get('/', function () {
    return view('welcome', ['name' => 'sison-app']);
});

// ✅ USERS ROUTE
Route::get('/users', [UserController::class, 'index']);

// ✅ PRODUCTS RESOURCE ROUTE
Route::resource('products', ProductController::class);

// ✅ SERVICE CONTAINER EXAMPLE
Route::get('/test-container', function (Request $request) {
    return $request->input('key');
});

// ✅ SERVICE PROVIDER TEST (Fixed incorrect `$UserService`)
Route::get('/test-provider', function (UserService $userService) {
    return $userService->listUsers();
});

// ✅ CONTROLLER TEST ROUTE
Route::get('/test-controller', [UserController::class, 'index']);

// ✅ FACADE TEST ROUTE (Fixed incorrect `$UserService`)
Route::get('/test-facade', function (UserService $userService) {
    return Response::json($userService->listUsers());
});

// ✅ ROUTE WITH PARAMETERS
Route::get('/post/{post}/comment/{comment}', function (string $post, string $comment) {
    return "Post ID: " . $post . ", Comment: " . $comment;
});

// ✅ FIXED PARAMETER MATCHING IN `post/{id}`
Route::get('/post/{id}', function (string $id) {
    return "Post ID: " . $id;
})->where('id', '[0-9]+'); // Only allows numbers

// ✅ FIXED `where` CONDITION FOR `/search/{search}`
Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*'); // Allows all characters

// ✅ NAMED ROUTE (ROUTE ALIAS)
Route::get('/test/route', function () {
    return route('test-route');
})->name('test-route');

// ✅ ROUTE MIDDLEWARE GROUP (Fixed `echo` -> `return` for HTTP response)
Route::middleware(['user-middleware'])->group(function () {
    Route::get('route-middleware-group/first', function () {
        return 'first'; // Changed `echo` to `return`
    });

    Route::get('route-middleware-group/second', function () {
        return 'second'; // Changed `echo` to `return`
    });
});

// ✅ CONTROLLER GROUPED ROUTES
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

// ✅ CSRF PROTECTION EXAMPLE
Route::get('/token', function () {
    return view('token');
});

Route::post('/token', function (Request $request) {
    return $request->all();
});

// ✅ VIEW WITH DATA (Fixed `Products.list` to lowercase `products.list`)
Route::get('/product-list', function (ProductService $productService) {
    return view('products.list', ['products' => $productService->listProducts()]);
});
