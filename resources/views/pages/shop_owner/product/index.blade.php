@extends('layouts.app')
@section('content')
    <div class="card shaontent')
<div class="container"dow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ __('Product List') }}</h4>
            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Add Product</a>
        </div>  
        <div class="card-body p-0">
            @if($products->count())
                <div class="table-responsive">
                    <table class="table table-striped text-capitalize text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Pics</th>
                                <th>Video</th>
                                <th>Types</th>
                                <th>Colors</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Shop</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->discount ? $product->discount . '%' : '-' }}</td>
                                <td>
                                    @if($product->pics)
                                        <img src="{{ asset('storage/' . $product->pics) }}" width="50" class="rounded">
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->video)
                                        <a href="{{ $product->video }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $product->types ?? '-' }}</td>
                                <td>{{ $product->colors ?? '-' }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ optional($product->category)->name ?? 'Uncategorized' }}</td>
                                <td>{{ optional($product->shop)->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info text-center m-0 p-4">
                    No products found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
