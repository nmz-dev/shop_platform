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
        Schema::create('order_details', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('order_id');
        $table->string('name');
        $table->longText('description')->nullable();
        $table->integer('price');
        $table->string('types')->nullable();   // comma separated types e.g. "cloth > xl,l,m,s; table > dimension"
        $table->string('colours')->nullable(); // comma separated

        $table->timestamps();

        // Foreign key constraint
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
