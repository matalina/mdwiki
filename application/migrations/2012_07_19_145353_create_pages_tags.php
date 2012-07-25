<?php

class Create_Pages_Tags {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page_tag', function($table) 
		{
      $table->increments('id');
      $table->integer('page_id');
      $table->integer('tag_id');
    });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages_tags');
	}

}