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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->integer('category_id');
            $table->string('name');
            $table->decimal('price');
            $table->longText('description');
            $table->string('condition');
            $table->string('type');
            $table->string('status')->nullable()->default('unpublish');
            $table->string('photo')->nullable();
            $table->string('owner_name');
            $table->string('country_code');
            $table->string('contact_number');
            $table->longText('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
