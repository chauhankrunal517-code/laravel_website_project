<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('product_key');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->index(['session_id', 'product_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};