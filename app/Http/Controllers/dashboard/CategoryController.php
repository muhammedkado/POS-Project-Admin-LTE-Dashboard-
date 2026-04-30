<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories_read')->only(['index']);
        $this->middleware('permission:categories_create')->only(['create', 'store']);
        $this->middleware('permission:categories_update')->only(['edit', 'update']);
        $this->middleware('permission:categories_delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $categories = Category::with('products')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($data);

        session()->flash('success', __('Added Successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($data);

        session()->flash('success', __('Updated Successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success', __('Deleted Successfully'));
        return redirect()->route('dashboard.categories.index');
    }
}
