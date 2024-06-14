<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductAPIController
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
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
        ]);

        $product = Product::create($request->all());

        $categories = $request->input('categories');
        if ($request->has('categories')) {
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

        return response()->json(['message' => 'Product created successfully.'], 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
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
            'photos64' => 'array',
            'photos' => 'array',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product->update($request->all());

        $product->categories()->detach();
        $categories = $request->input('categories');

        if ($request->has('categories')) {
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

        return response()->json(['message' => 'Product updated successfully.']);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }

}