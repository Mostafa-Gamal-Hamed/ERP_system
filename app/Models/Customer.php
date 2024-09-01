<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'address',
    ];

    // Relationship
    public function sale()
    {
        return $this->hasMany(Sale::class, "product");
    }
}
