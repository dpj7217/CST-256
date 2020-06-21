<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationHistoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_history_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profileID', false, true);
            $table->string('institutionName');
            $table->boolean('current')->nullable();
            $table->date('from');
            $table->date('to');
            $table->timestamps();

            $table->foreign('profileID')->references('id')->on('education_history')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_histor_details');
    }
}
