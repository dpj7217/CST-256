<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoriesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jobHistoryID', false, true);
            $table->string('companyName');
            $table->string('role');
            $table->text('description');
            $table->boolean('current')->nullable();
            $table->date('from');
            $table->date('to');
            $table->timestamps();

            $table->foreign('jobHistoryID')->references('id')->on('job_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_histories_details');
    }
}
