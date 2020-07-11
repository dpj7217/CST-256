<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('user_id'); //creator of the job
            $table->unsignedBigInteger('company_id');
            $table->text('description');
            $table->string('department');
            $table->boolean('isRemote')->nullable();
            $table->unsignedBigInteger('startingSalary');
            $table->integer('yearsExperience')->nullable();
            $table->integer('degreeNeeded')->nullable(); //GED, High School Diploma, Some College, Bachelors, Masters, Doctorate
            $table->integer('jobType'); //intern, entry, experienced, senior, c-level
            $table->text('otherRequirements')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
