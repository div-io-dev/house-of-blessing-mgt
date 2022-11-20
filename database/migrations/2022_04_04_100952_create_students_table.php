<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('student_number');
            $table->integer('class__id')->unsigned()->index();
            $table->integer('parent__id')->unsigned()->index();
            $table->integer('bus_stop_id')->unsigned()->index()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names')->nullable();
            $table->date('dob')->nullable();
            $table->string('profile_image')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('added_by_id')->unsigned()->index();
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
        Schema::dropIfExists('students');
    }
};
