<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
    ];

    public static function search($query = null, $minPrice = null, $maxPrice = null)
    {
        return self::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
        ->when($minPrice, function ($queryBuilder) use ($minPrice) {
            return $queryBuilder->where('price', '>=', $minPrice);
        })
        ->when($maxPrice, function ($queryBuilder) use ($maxPrice) {
            return $queryBuilder->where('price', '<=', $maxPrice);
        });
    }
    

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
