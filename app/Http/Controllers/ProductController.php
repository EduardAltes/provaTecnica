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
            'end_dates.*' => 'date|after_or_equal:start_dates.*',
            'prices' => 'array',
            'prices.*' => ['numeric', 'between:0,999.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'photos' => 'array',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ],  [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            
            'description.string' => 'The description must be a string.',
            
            'categories.array' => 'The categories must be an array.',
            'categories.*.integer' => 'Each category ID must be an integer.',
            'categories.*.exists' => 'Each category ID must exist in the categories table.',
            
            'start_dates.array' => 'The start dates must be an array.',
            'start_dates.*.date' => 'Each start date must be a valid date.',
            
            'end_dates.array' => 'The end dates must be an array.',
            'end_dates.*.date' => 'Each end date must be a valid date.',
            'end_dates.*.after_or_equal' => 'Each end date must be after or equal to the corresponding start date.',
            
            'prices.array' => 'The prices must be an array.',
            'prices.*.numeric' => 'Each price must be a number.',
            'prices.*.between' => 'Each price must be between 0 and 999.99.',
            'prices.*.regex' => 'Each price must be a valid monetary amount (up to two decimal places).',
            
            'photos.array' => 'The photos must be an array.',
            'photos.*.image' => 'Each photo must be an image.',
            'photos.*.mimes' => 'Each photo must be a file of type: jpg, jpeg, png.',
            'photos.*.max' => 'Each photo may not be greater than 2048 kilobytes.',
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

                if (!is_null($price) || !is_null($start_date) || !is_null($end_date) ) {
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
            'start_dates' => 'array',
            'start_dates.*' => 'date',
            'end_dates' => 'array',
            'end_dates.*' => 'date',
            'prices' => 'array',
            'prices.*' => ['numeric', 'between:0,999.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'photosBinary' => 'array',
            // 'photosBinary.*' => 'regex:/^[a-f0-9]+$/i',
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
        $product->prices()->delete();

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
       
        $photos64 = $request->input('photos64');
        
        $product->photos()->delete();

        if ($request->has('photos64')) {
            foreach ($photos64 as $photo) {
                $product->photos()->create(['photo' => base64_decode($photo)]);
            }
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
