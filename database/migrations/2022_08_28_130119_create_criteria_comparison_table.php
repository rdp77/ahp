<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaComparisonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria_comparison', function (Blueprint $table) {
            $table->id();
            $table->foreignId('first_criteria_id')->constrained('ratio')->onDelete('cascade');
            $table->float('value');
            $table->foreignId('second_criteria_id')->constrained('ratio')->onDelete('cascade');
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
        Schema::dropIfExists('criteria_comparison');
    }
}
