<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username', 100)->nullable();
			$table->string('first_name', 255)->nullable();
			$table->string('last_name', 255)->nullable();
			$table->string('mobile', 50)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('password')->nullable();
			$table->enum('status', array('active', 'inactive'))->nullable();
			$table->enum('user_type', array('user', 'admin'))->nullable()->default('user');
			$table->integer('created_by')->default(0);
			$table->integer('updated_by')->default(0);
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('user');
	}
}
