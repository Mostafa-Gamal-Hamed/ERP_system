<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["name"];

    // Relationship
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
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
