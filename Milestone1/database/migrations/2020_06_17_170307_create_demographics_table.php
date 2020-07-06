<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demographics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profile_id', false, true);
            $table->string('profileImageLocation');
            $table->string('bannerImageLocation');
            $table->integer('age');
            $table->string('gender')->nullable();
            $table->string('race')->nullable();
            $table->string('fromCity');
            $table->string('currentCity');
            $table->date('birthday');
            $table->text('bio');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demographics');
    }
}
