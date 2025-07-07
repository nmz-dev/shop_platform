@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}</div>
                <div class="card-body">
                    @include('pages.shop_owner.product.partials.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
