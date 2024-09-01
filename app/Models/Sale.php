<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'customers_id',
        'categories_id',
        'purchases_id',
        'quantity',
        'price',
        'total',
    ];

    // Relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class, "customers_id");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "categories_id");
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, "purchases_id");
    }
    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
}
