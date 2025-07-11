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
            $table->string('no');
            $table->text('delivery_date')->nullable();
            $table->decimal('remark', 10, 2);
            $table->string('user_code')->default(0);
            $table->string('pics')->nullable();
            $table->string('types')->nullable();
            $table->string('colors')->nullable();
            $table->foreignId('shop_id');
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
