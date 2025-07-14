@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Order List</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Delivery Date</th>
                <th>Remark</th>
                <th>User Code</th>
                <th>Status</th>
                <th>Actions</th> <!-- Only Reject button -->
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->no }}</td>
                <td>{{ $order->delivery_date }}</td>
                <td>{{ $order->remark }}</td>
                <td>{{ $order->user_code }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>
                    @if($order->status != 'rejected')
                    <form action="{{ route('order.reject', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Reject this order?')">Reject</button>
                    </form>
                    @else
                        <span class="text-muted">Rejected</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
