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
        Schema::create('class_scores', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->integer('student_id')->index()->unsigned();
            $table->integer('class__id')->index()->unsigned();
            $table->integer('subject_id')->index()->unsigned();
            $table->integer('semester_id')->index()->unsigned();
            $table->integer('teacher_id')->index()->unsigned()->nullable();

            $table->double('class_score')->default(0);
            $table->double('exam_score')->default(0);

            $table->double('is_locked')->default(false);

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
        Schema::dropIfExists('class_scores');
    }
};
