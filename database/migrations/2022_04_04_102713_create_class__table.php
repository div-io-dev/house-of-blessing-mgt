<?php

use App\Models\Class_;
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
        Schema::create('class_', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('name');

            $table->boolean('is_active')->default(true);
            $table->integer('added_by_id')->unsigned()->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Class_::create([
            'name' => 'Primary 1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_');
    }
};
