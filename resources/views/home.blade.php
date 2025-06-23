@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shop') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div>
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('shop.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="profile_pic">Profile Picture</label>
                            <input type="text" id="profile_pic" name="profile_pic" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Description</label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
