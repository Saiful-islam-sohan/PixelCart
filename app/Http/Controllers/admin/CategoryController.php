<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status'      => 'boolean',
        ]);


        $validated['slug'] = Str::slug($request['name']);


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        Category::create($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category created.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Category not found.');
        }

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status'      => 'boolean',
        ]);


        $validated['slug'] = Str::slug($request['name']);


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        $category->update($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted.');
    }
}
