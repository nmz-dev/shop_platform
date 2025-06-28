@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($shop)
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset($shop->profile_pic) }}" class="d-inline" alt="Shop Image" width="40" height="40">
                                </div>
                                <div class="col-md-9">
                                    <h3 class="d-inline">{{ $shop->name }}</h3>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-header">{{ __('Shop information') }}</div>
                    @endif
                    <div class="card-body">
                        @include('pages.shop_owner.shop.partials.form')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
