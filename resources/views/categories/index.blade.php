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
                    <i class="bi bi-tags me-2"></i>Manage Categories
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-plus-circle me-2"></i>New Category
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Add Category
                        </button>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </button>
                                        </form>
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
