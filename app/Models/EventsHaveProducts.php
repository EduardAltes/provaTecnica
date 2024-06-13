<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsHaveProducts extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'product_id'];
  
    public function product()
    {
      return $this->belongsTo(Product::class, 'product_id');
    }
  
    public function event()
    {
      return $this->belongsTo(Event::class, 'event_id');
    }
}
