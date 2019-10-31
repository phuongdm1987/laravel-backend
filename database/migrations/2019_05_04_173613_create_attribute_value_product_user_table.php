<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAttributeValueProductUserTable
 */
class CreateAttributeValueProductUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('attribute_value_product_user', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_value_id');
            $table->unsignedBigInteger('attribute_id');
            $table->string('product_user_id');
            $table->primary(['attribute_value_id', 'product_user_id'], 'avpu_avi_pui_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_value_product_user');
    }
}
