<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['date'];

    public function products()
    {
      return $this->belongsToMany(Product::class, 'events_have_products', 'event_id', 'product_id')->withPivot('units');;
    }

    public function units()
    {
      return $this->hasMany(EventsHaveProducts::class, 'id', 'product_id');
    }
    
}
