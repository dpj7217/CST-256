<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationHistoriesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_histories_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('educationHistoryID', false, true);
            $table->string('institutionName');
            $table->string('major');
            $table->boolean('current')->nullable();
            $table->date('from');
            $table->date('to');
            $table->timestamps();

            $table->foreign('educationHistoryID')->references('id')->on('education_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_histories_details');
    }
}
