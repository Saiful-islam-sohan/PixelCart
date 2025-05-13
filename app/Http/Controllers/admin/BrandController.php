<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }
    public function create()
    {
        return view('admin.brands.create');
    }


    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'status' => 'boolean',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();

            // Store in public storage
            $path = $image->storeAs('brands', $filename, 'public');

            // Save path for database
            $validated['image'] = '/storage/' . $path;
        }

         //dd($validated);
         Brand::create($validated);


        return redirect()->route('admin.brand.index')
            ->with('success', 'Brand created successfully');
    }






    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        // Delete the image from storage
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return redirect()->route('admin.brand.index')->with('success', 'Brand deleted successfully!');
    }
}
