<?php

// database/migrations/2024_06_04_1413_create_products_have_prices_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('products_have_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('products_have_prices');
    }
};