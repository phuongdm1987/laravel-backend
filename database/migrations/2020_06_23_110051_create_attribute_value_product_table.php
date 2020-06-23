<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::create('attribute_value_product', static function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_value_id');
            $table->unsignedBigInteger('product_id');
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
