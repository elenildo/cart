<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('localizator')->unique();
            $table->decimal('discount', 8, 2)->default(0);
            $table->enum('discount_mode', ['valor', 'perc'])->default('perc');
            $table->decimal('limit', 8, 2)->default(0);
            $table->enum('limit_mode', ['valor', 'qtd'])->default('qtd');
            $table->datetime('dthr_validate');
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
