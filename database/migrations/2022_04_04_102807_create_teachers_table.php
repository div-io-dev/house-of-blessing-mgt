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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('name');
            $table->string('username');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->string('salary');
            $table->string('certificate');
            $table->string('certificate_path')->nullable();
            $table->string('profile_image_path')->nullable();

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
        Schema::dropIfExists('teachers');
    }
};
