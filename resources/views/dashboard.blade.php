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
                        <a href="{{ route('income.index') }}" class="list-group-item list-group-item-action">
    <i class="bi bi-graph-up me-2"></i>Track Income
</a>

<a href="{{ route('admin.settings') }}" class="list-group-item list-group-item-action">
    <i class="bi bi-gear me-2"></i>Admin Settings
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
                    <i class="bi bi-house-heart me-2"></i>Dashboard
                </div>
                <div class="card-body">
                    <h2 class="text-center mb-4" style="font-family: 'Courgette', cursive; color: var(--primary-color);">
                        Welcome to The Bean Scene
                    </h2>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <i class="bi bi-cup-hot display-4 text-primary mb-2"></i>
                                    <h5 class="card-title">Products</h5>
                                    <p class="card-text">Manage your café menu items</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <i class="bi bi-receipt display-4 text-success mb-2"></i>
                                    <h5 class="card-title">Orders</h5>
                                    <p class="card-text">Track and manage orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <i class="bi bi-tags display-4 text-info mb-2"></i>
                                    <h5 class="card-title">Categories</h5>
                                    <p class="card-text">Organize your menu items</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@endsection