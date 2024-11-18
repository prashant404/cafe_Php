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
                    <i class="bi bi-graph-up me-2"></i>Income Dashboard
                </div>
                <div class="card-body">
                    <h2 class="text-center mb-4">Daily Income Tracking</h2>

                    <!-- Date Filter Form -->
                    <form method="GET" action="{{ route('income.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate->toDateString() }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate->toDateString() }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mt-4">Filter</button>
                            </div>
                        </div>
                    </form>

                    <!-- Total Income Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Total Income</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">₹ {{ number_format($totalIncome, 2) }}</h4>
                        </div>
                    </div>

                    <!-- Orders List -->
                    <h5>Orders from {{ $startDate->toFormattedDateString() }} to {{ $endDate->toFormattedDateString() }}</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>₹ {{ number_format($order->total, 2) }} </td>
                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
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
