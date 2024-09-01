<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','type','comment','quantity','price','total','created_at','updated_at'];

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
}
