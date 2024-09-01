<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id',
        'purchases_id',
        'quantity',
    ];

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class, "categories_id");
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, "purchases_id");
    }
}
