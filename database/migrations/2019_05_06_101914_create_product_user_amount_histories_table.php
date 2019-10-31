<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProductUserAmountHistoriesTable
 */
class CreateProductUserAmountHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_user_amount_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_user_id');
            $table->unsignedBigInteger('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_user_amount_histories');
    }
}
