<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAttributeEntityTable
 */
class CreateAttributeEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rinvex.attributes.tables.attribute_entity'), function (Blueprint $table) {
            // Columns
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->string('entity_type');
            $table->integer('entity_id')->unsigned()->nullable(); // TODO: Making this nullable for now as it breaks the basic features
            $table->unsignedBigInteger('created_by')->index()->default(0);
            $table->timestamps();

            // Indexes
            $table->unique(['attribute_id', 'entity_type'], 'attributable_attribute_id_entity_type');
            $table->foreign('attribute_id')->references('id')->on(config('rinvex.attributes.tables.attributes'))
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('rinvex.attributes.tables.attribute_entity'));
    }
}
