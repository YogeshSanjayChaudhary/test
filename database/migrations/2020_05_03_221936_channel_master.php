<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChannelMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('channel_master', function (Blueprint $table) {
			$table->increments('id');
			$table->string('channel_name', 255)->nullable();
			$table->text('channel_description')->nullable();
			$table->enum('status', array('active', 'inactive'))->nullable();
			$table->string('channel_url', 255)->nullable();
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
        //
    }
}
