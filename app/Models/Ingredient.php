<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit', 'stock', 'min_stock', 'cost_per_unit', 'description'];

    protected $casts = [
        'stock'         => 'decimal:2',
        'min_stock'     => 'decimal:2',
        'cost_per_unit' => 'decimal:2',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_ingredients')
                    ->withPivot('quantity_used')
                    ->withTimestamps();
    }

    /**
     * Cek apakah stok sudah di bawah minimum.
     */
    public function isLowStock(): bool
    {
        return $this->stock <= $this->min_stock;
    }
}
