<?php

namespace App\Http\Controllers;

class MenuController
{
    public function categories()
    {
        return view('categories.inndex');
    }

    public function products()
    {
        return view('products.index');
    }
}

