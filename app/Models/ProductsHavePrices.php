<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductsHavePrices extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'start_date', 'end_date', 'price'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
}