<?php

namespace App\Http\Controllers;

class MenuController
{
    public function categories()
    {
        return view('categories.index');
    }

    public function products()
    {
        return view('products.index');
    }

    public function calendar()
    {
        return view('calendar.index');
    }
}

