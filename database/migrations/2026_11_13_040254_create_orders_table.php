
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_number')->unique();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id');

            $table->string('customer_name');
            $table->string('phone', 15);
            $table->text('address');
            $table->string('city');
            $table->string('pincode', 10);

            $table->json('items');
            $table->decimal('total', 10, 2);

            $table->string('payment_method');
            $table->string('payment_status')->default('Pending');
            $table->string('payment_reference')->nullable();

            $table->string('order_status')->default('Confirmed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
