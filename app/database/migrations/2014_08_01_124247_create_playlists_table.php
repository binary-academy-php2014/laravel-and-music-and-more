<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('playlists', function(Blueprint $table) {
        	$table->dropForeign('playlists_user_id_foreign');    
        });
        
		Schema::drop('playlists');
	}

}