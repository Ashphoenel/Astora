<?php

use Ashphoenel\Astora\Models\Cart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->foreignIdFor(Cart::class);
            $table->morphs('product');
            $table->decimal('subtotal')->default(0);
            $table->decimal('base_price')->default(0);
            $table->string('currency');
            $table->unsignedSmallInteger('quantity');
            $table->timestampsTz();
        });
    }
};
