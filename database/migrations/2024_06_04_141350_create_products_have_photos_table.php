
<?php
// database/migrations/2024_06_04_1413_create_product_has_photos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('products_have_photos', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->binary('photo');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');;
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('products_have_photos');
    }
};