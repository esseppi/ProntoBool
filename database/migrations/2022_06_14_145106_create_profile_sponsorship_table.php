<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_sponsorship', function (Blueprint $table) {

            $table->id();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->unsignedBigInteger('sponsorship_id');
            $table->unsignedBigInteger('profile_id');
            $table->boolean('isActive');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_sponsorship');
    }
}
