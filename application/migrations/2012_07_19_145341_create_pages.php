<?php

class Create_Pages {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table) 
		{
      $table->increments('id');
      $table->string('slug',100)->unique();
      $table->string('title',100);
      $table->text('content');
      $table->timestamps();
    });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}