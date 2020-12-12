<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('citizenship_country_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
			
			$table->index('user_id');
			$table->index('citizenship_country_id');
			
			$table
				->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade')
				;
			
			$table
				->foreign('citizenship_country_id')
				->references('id')
				->on('countries')
				->onDelete('cascade')
				;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
