<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'categories' => 'array',
            'categories.*' => 'integer|exists:categories,id',
            'start_dates' => 'array',
            'start_dates.*' => 'date',
            'end_dates' => 'array',
            'end_dates.*' => 'date',
            'prices' => 'array',
            'prices.*' => ['numeric', 'between:0,99.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'photos' => 'array',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $product = Product::create($request->all());

        $categories = $request->input('categories');
        if($request->has('categories')) {
            foreach ($categories as $category) {
                $product->categories()->attach($category);
            }
        }

        $prices = $request->input('prices');
        $start_dates = $request->input('start_dates');
        $end_dates = $request->input('end_dates');
        
        if ($request->has('prices') && $request->has('start_dates') && $request->has('end_dates')) {
            for ($i = 0; $i < count($prices); $i++) {
                $price = $prices[$i] ?? null;
                $start_date = $start_dates[$i] ?? null;
                $end_date = $end_dates[$i] ?? null;

                if (!is_null($price) || !is_null($start_date) || !is_null($end_date)) {
                    $product->prices()->create([
                        'price' => $price,
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ]);
                }
            }
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoBinary = file_get_contents($photo);
                $product->photos()->create(['photo' => $photoBinary]);
            }
        }
        
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product, )
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {   
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'categories' => 'array',
            'categories.*' => 'integer|exists:categories,id',
            'photos' => 'array',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $product->update($request->all());
    
        $product->categories()->detach();
        $categories = $request->input('categories');

        if($request->has('categories')) {
            foreach ($categories as $category) {
                $product->categories()->attach($category);
            }
        }

        if($request->has('delete')) {
            $product->photos()->delete();
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoBinary = file_get_contents($photo);
                $product->photos()->create(['photo' => $photoBinary]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
