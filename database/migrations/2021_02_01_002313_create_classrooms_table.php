<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table) {
			$table->id('id');
			$table->string('Name_class');
			$table->bigInteger('grade_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('classrooms');
	}
}
