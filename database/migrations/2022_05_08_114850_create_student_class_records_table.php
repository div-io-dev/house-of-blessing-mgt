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
        Schema::create('student_class_records', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->integer('student_id')->index()->unsigned();
            $table->integer('class__id')->index()->unsigned();
            $table->json('semesters')->nullable();
            $table->string('academic_position')->nullable();
            $table->string('overall_raw_score')->nullable();

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
        Schema::dropIfExists('student_class_records');
    }
};
