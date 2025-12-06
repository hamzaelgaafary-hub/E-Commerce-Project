<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // nullable إذا كان المستخدم غير مسجل
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('Pending'); // مثل Pending, Processing, Shipped, Completed
            // تخزين معلومات الشحن والعميل كـ JSON
            $table->json('shipping_address'); 
            $table->json('customer_info');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
