<?php

class Create_Right_User {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('right_user', function($table) {
      $table->increments('id');
      $table->integer('right_id');
      $table->integer('user_id');
      
    });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('right_user');
	}

}