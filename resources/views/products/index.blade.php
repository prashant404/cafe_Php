@extends('layouts.app')

@section('styles')
    <style>
        /* Reduce the size of the pagination arrows and text */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px; /* Smaller font size for pagination text */
        }

        .pagination .page-link {
            padding: 6px 12px; /* Adjust padding for smaller links */
            font-size: 14px; /* Ensure the link text is smaller */
        }

        .pagination .page-item {
            margin: 0 3px; /* Add spacing between page items */
        }

        .pagination .page-item.disabled .page-link,
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .pagination .page-link {
            border: 1px solid #ddd; /* Border color for page links */
            border-radius: 4px;
        }

        .pagination .page-link:hover {
            background-color: #f0f0f0; /* Hover effect */
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            font-size: 14px; /* Adjust the size for the first/last arrows */
        }

        /* Optional: Style the arrows to make them look better */
        .pagination .page-item .page-link::before {
            font-size: 18px; /* Resize arrows */
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1>Products</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Updated Filter Form -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td class="text-center">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-thumbnail"
                                     style="max-width: 100px; height: auto;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.edit', $product->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection
