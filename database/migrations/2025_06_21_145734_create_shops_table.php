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
        $table->string("address");
        $table->string("postal_code");
        $table->string("phone");
        $table->timestamps();

        $table->foreignId('user_id');
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
