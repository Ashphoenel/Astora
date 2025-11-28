<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->string('owner_key')->nullable();
            $table->decimal('subtotal')->default(0);
            $table->decimal('total')->default(0);
            $table->string('currency');
            $table->string('state');
            $table->nullableMorphs('customer');
            $table->timestampTz('expires_at');
            $table->timestampsTz();
        });
    }
};
