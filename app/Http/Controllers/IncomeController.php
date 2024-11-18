<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        // Default to the current date range if no date is selected
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Check if start and end dates are passed from the filter
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
        }

        // Get the orders within the date range
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

        // Calculate total income within the date range
        $totalIncome = $orders->sum('total');

        return view('income.index', compact('orders', 'startDate', 'endDate', 'totalIncome'));
    }
}
