<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;
  protected $fillable = ['name', 'description'];

  public function categories()
  {
    return $this->belongsToMany(Category::class, 'products_have_categories', 'product_id', 'category_id');
  }

  public function photos()
  {
    return $this->hasMany(ProductsHavePhotos::class, 'product_id');
  }

  public function prices()
  {
    return $this->hasMany(ProductsHavePrices::class, 'product_id');
  }

  public function events()
  {
    return $this->belongsToMany(Event::class, 'events_have_products', 'event_id', 'product_id');
  }
  
}
