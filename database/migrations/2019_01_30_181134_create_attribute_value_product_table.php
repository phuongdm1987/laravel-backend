<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAttributeValueProductTable
 */
class CreateAttributeValueProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('attribute_value_product', function (Blueprint $table) {
            $table->unsignedInteger('attribute_value_id');
            $table->unsignedInteger('attribute_id');
            $table->unsignedInteger('product_id');
            $table->unsignedBigInteger('amount')->default(0);
            $table->primary(['attribute_value_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_product');
    }
}
