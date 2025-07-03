@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Product List') }}</div>
                    <div class="card-body">
                        <table class="table table-striped text-capitalize">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>name</th>
                                <th>shop</th>
                                <th>price</th>
                                <th>discount</th>
                                <th>pics</th>
                                <th>video</th>
                                <th>types</th>
                                <th>colors</th>
                                <th>stock</th>
                                <th>category</th>
                                <th>shop</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->discount}}</td>
                                    <td>{{$product->pics}}</td>
                                    <td>{{$product->video}}</td>
                                    <td>{{$product->types}}</td>
                                    <td>{{$product->colors}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->shop->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
