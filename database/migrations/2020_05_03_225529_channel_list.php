<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChannelList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('channel_list', function (Blueprint $table) {
			$table->increments('id');
                        $table->integer('channel_id')->default(0);
			$table->string('class_name', 255)->nullable();
			$table->string('class_key', 255)->nullable();
			$table->enum('status', array('active', 'inactive'))->nullable();
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
