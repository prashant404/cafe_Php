@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-list me-2"></i>Menu
                </div>
                <div class="card-body p-2">
                    <div class="list-group">
                        <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-cup-hot me-2"></i>Manage Products
                        </a>
                        <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-receipt me-2"></i>View Orders
                        </a>
                        <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-tags me-2"></i>Manage Categories
                        </a>
                        <a href="{{ route('logout') }}" 
                           class="list-group-item list-group-item-action text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-receipt me-2"></i>Orders
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Daily Income:</strong> ₹{{ number_format($dailyIncome, 2) }}
                    </div>
                    
                    <a href="{{ route('orders.create') }}" class="btn btn-success mb-3">
                        <i class="bi bi-plus-circle me-2"></i>Create New Order
                    </a>

                    <table class="table table-striped">
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
                                        <a href="{{ route('orders.pdf', $order->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-file-earmark-arrow-down me-2"></i>Download PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
