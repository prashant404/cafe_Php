@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Orders</h1>

    <!-- Daily Income -->
    <div class="alert alert-info">
        <strong>Daily Income:</strong> ₹{{ number_format($dailyIncome, 2) }}
    </div>

    <!-- Create Order Button -->
    <a href="{{ route('orders.create') }}" class="btn btn-success mb-3">Create New Order</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Products</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>₹{{ number_format($order->total, 2) }}</td>
                <td>
                    <ul>
                        @foreach($order->products as $product)
                        <li>{{ $product->name }} (x{{ $product->pivot->quantity }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <!-- Download PDF Button -->
                    <a href="{{ route('orders.pdf', $order->id) }}" class="btn btn-sm btn-primary">Download PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
