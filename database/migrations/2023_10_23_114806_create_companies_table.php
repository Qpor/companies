<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('company_id');
            $table->string('company_name', 256);
            $table->string('company_registration_number');
            $table->date('company_foundation_date');
            $table->string('country', 64);
            $table->integer('zip_code');
            $table->string('city', 128);
            $table->string('street_address', 256);
            $table->double('latitude', null, 2);
            $table->double('longitude', null, 2);
            $table->string('company_owner', 128);
            $table->integer('employees');
            $table->string('activity', 32);
            $table->boolean('active');
            $table->string('email', 320);
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
