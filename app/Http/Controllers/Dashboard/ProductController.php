<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products_read')->only(['index']);
        $this->middleware('permission:products_create')->only(['create', 'store']);
        $this->middleware('permission:products_update')->only(['edit', 'update']);
        $this->middleware('permission:products_delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'purchasing_price'  => 'required|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
        ]);

        $data['image'] = $this->uploadImage($request) ?? 'default.jpg';

        Product::create($data);

        session()->flash('success', __('Added Successfully'));
        return redirect()->route('dashboard.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'purchasing_price'  => 'required|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteOldImage($product->image);
            $data['image'] = $this->uploadImage($request);
        } else {
            unset($data['image']);
        }

        $product->update($data);

        session()->flash('success', __('Updated Successfully'));
        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {
        $this->deleteOldImage($product->image);
        $product->delete();

        session()->flash('success', __('Deleted Successfully'));
        return redirect()->route('dashboard.products.index');
    }

    protected function uploadImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/product_images'), $filename);

        return $filename;
    }

    protected function deleteOldImage(?string $image): void
    {
        if (! $image || $image === 'default.jpg') {
            return;
        }

        $path = public_path('uploads/product_images/' . $image);
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}
