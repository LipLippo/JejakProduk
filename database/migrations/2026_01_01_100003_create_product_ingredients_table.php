<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pivot: menghubungkan produk ke bahan baku yang digunakan.
     * Satu produk bisa menggunakan banyak bahan baku.
     */
    public function up(): void
    {
        Schema::create('product_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('ingredient_id')->constrained('ingredients')->cascadeOnDelete();
            $table->decimal('quantity_used', 10, 2); // Jumlah bahan yang dipakai per 1 produk terjual
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_ingredients');
    }
};
