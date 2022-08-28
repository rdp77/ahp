<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativePrioritieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative_prioritie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->constrained('ratio')->onDelete('cascade');
            $table->foreignId('alternative_id')->constrained('ratio')->onDelete('cascade');
            $table->float('value', 8, 5);
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
        Schema::dropIfExists('alternative_prioritie');
    }
}
