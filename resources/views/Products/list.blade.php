@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="container">
        <h1>Product List</h1>

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
    </div>
@endsection
