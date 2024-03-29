<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawScoreToScaledScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_score_to_scaled_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('rawscore');
            $table->mediumInteger('scaledscore');
            $table->string('type', 11);
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
        Schema::dropIfExists('raw_score_to_scaled_scores');
    }
}
