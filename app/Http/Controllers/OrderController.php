<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve orders with related products
        $orders = Order::with('products')->latest()->get();

        // Calculate daily income
        $dailyIncome = Order::whereDate('created_at', now()->toDateString())->sum('total');

        return view('orders.index', compact('orders', 'dailyIncome'));
    }

    public function create()
    {
        // Retrieve all categories to display on the order creation page
        $categories = Category::all();
        return view('orders.create', compact('categories'));
    }

    public function generatePDF($id)
    {
        // Retrieve the order and related products for PDF generation
        $order = Order::with('products')->findOrFail($id);
        $pdf = Pdf::loadView('orders.pdf', compact('order'));
        return $pdf->download('order_' . $id . '_bill.pdf');
    }

    public function store(Request $request)
    {
        Log::info('Order creation process started.');
    
        try {
            // Decode the 'products' JSON string
            $products = json_decode($request->input('products'), true);
    
            if (!is_array($products)) {
                throw new \Exception("The 'products' field is not a valid JSON array.");
            }
    
            Log::info('Decoded products:', $products);
    
            // Validate the decoded data
            $validated = $request->validate([
                'products' => 'required',
                'products.*.id' => 'required|exists:products,id',
                'products.*.quantity' => 'required|integer|min:1',
            ]);
    
            Log::info('Validation passed.');
    
            // Calculate total price and create the order
            $order = new Order();
            $order->total = collect($products)->sum(function ($product) {
                $productModel = Product::findOrFail($product['id']);
                return $productModel->price * $product['quantity'];
            });
            $order->items = json_encode($products);
            $order->save();
    
            Log::info('Order created with ID:', ['id' => $order->id]);
    
            // Attach products to the order
            foreach ($products as $product) {
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
                Log::info('Attached product:', $product);
            }
    
            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            Log::error('Error during order creation:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to create order.');
        }
    }
    
}
