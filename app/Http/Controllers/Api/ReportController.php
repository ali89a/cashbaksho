<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report()
    {
        $total_products = Product::where('shop_id', auth('user-api')->user()->shop_id)->count();
        $total_sales = Sale::where('shop_id', auth('user-api')->user()->shop_id)->sum('amount');
        $total_purchases = Purchase::where('shop_id', auth('user-api')->user()->shop_id)->sum('amount');
        return response()->json([
            'success' => true,
            'data' => [
                'total_products' => $total_products,
                'total_sales' => $total_sales,
                'total_purchases' => $total_purchases,
            ]
        ]);
    }
    public function transaction()
    {
        $transactions = Transaction::with('transactionable')->where('shop_id', auth('user-api')->user()->shop_id)->latest()->take(5)->get();
        return response()->json([
            'success' => true,
            'transactions' => $transactions,
        ]);
    }
}
