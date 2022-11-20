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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('bill_code');
            $table->float('amount');
            $table->float('amount_paid')->default(0.00);
            $table->morphs('billable');
            $table->string('type')->nullable(); // fees or other
            $table->integer('fee_id')->unsigned()->index()->nullable();
            $table->integer('semester_id')->unsigned()->index()->nullable();

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
        Schema::dropIfExists('bills');
    }
};
