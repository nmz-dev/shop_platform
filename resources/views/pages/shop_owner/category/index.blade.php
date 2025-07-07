@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{route('category.create')}}" class="btn btn-primary">Add Category</a>
                    </div>
                    <div class="card-header">{{ __('Category List') }}</div>
                    <div class="card-body">
                        <table class="table table-striped text-capitalize text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>name</th>
                                <th>shop</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->shop->name}}</td>
                                    <td>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="{{route('category.show', $category->id)}}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger d-inline-block">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
