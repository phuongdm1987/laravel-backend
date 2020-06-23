<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAttributeValuesTable
 */
class CreateAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('attribute_values', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id')->index();
            $table->string('value', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
}
