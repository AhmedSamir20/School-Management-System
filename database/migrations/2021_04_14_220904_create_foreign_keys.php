<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('class_id')->references('id')->on('classrooms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

        Schema::table('my__parents', function(Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });

        Schema::table('parent_attachments', function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

	}

	public function down()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->dropForeign('classrooms_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_class_id_foreign');
		});
	}
}
