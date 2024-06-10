<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;
  protected $fillable = ['name', 'description', 'father_id'];

  public function products()
  {
    return $this->belongsToMany(Product::class, 'products_have_categories', 'category_id', 'product_id');
  }

  public function children()
  {
    return $this->hasMany(Category::class, 'father_id');
  }
}