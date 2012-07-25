<?php

class Create_Rights {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rights', function($table) {
      $table->increments('id');
      $table->string('right', 128)->unique();
    });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rights');
	}

}