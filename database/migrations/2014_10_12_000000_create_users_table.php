<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('mode_of_application');
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('nric_no');
            $table->date('date_of_birth');
            $table->string('citizenship');
            $table->string('race');
            $table->string('phone');
            $table->string('marital_status');
            $table->string('driving_license');
            $table->string('current_salary');
            $table->date('earliest_commencement_date');
            $table->string('expected_salary');
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
        Schema::dropIfExists('users');
    }
};
