<?php

class Create_Tags {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function($table) 
		{
		  $table->increments('id');
      $table->string('slug',50)->unique();
      $table->string('tag',50);
    });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
	}

}