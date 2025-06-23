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
       Schema::create('shops', function (Blueprint $table) {
        $table->id();
        $table->string("name");
        $table->string("profile_pic")->nullable();
        $table->text("description")->nullable();
        $table->string("social_links")->nullable();
        $table->string("street")->nullable();
        $table->string("unit")->nullable();
        $table->string("address")->nullable();
        $table->string("postal_code")->nullable();
        $table->string("phone")->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
