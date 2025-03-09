@extends('layouts.app')

@section('title', 'Filtered Product List')

@section('content')
    <div class="container">
        <h1>Products:</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['category'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No products available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h2>Tasks:</h2>
        <ul>
            @forelse ($tasks ?? [] as $task) 
                <li>{{ $task }}</li>
            @empty
                <li>Add to Cart</li>
                <li>Checkout</li>
            @endforelse
        </ul>

        <h2>Global Variables:</h2>
        <p>Shared Variable: {{ $sharedVariable ?? 'I am shared now' }}</p>
        <p>Product Key: {{ $productKey ?? 'abc123' }}</p>
    </div>
@endsection
