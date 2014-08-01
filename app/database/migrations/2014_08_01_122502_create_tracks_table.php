<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tracks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('album_id')->unsigned();
            $table->integer('artist_id')->unsigned();
            $table->integer('genre_id')->unsigned()->nullable();//if null - then album's genre will be used
            $table->string('title');
            $table->text('lyrics');
            
            $table->foreign('album_id')
                  ->references('id')
                  ->on('albums');
            
            $table->foreign('artist_id')
                  ->references('id')
                  ->on('artists');
            
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('tracks', function(Blueprint $table)
        {
        	$table->dropForeign('tracks_album_id_foreign');    
            $table->dropForeign('tracks_genre_id_foreign');
            $table->dropForeign('tracks_artist_id_foreign');
        });
        
		Schema::drop('tracks');
	}

}
