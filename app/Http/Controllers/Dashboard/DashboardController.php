<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'clients' => Client::count(),
            'users' => User::count(),
            'inventory_value' => Product::selectRaw('SUM(purchasing_price * stock) as total')->value('total') ?? 0,
        ];

        $lowStock = Product::with('category')
            ->where('stock', '<', 5)
            ->orderBy('stock')
            ->limit(5)
            ->get();

        $latestProducts = Product::with('category')
            ->latest()
            ->limit(5)
            ->get();

        $productsPerCategory = Category::withCount('products')->orderByDesc('products_count')->get();

        return view('dashboard.index', compact('stats', 'lowStock', 'latestProducts', 'productsPerCategory'));
    }
}
