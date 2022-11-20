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
        Schema::create('bus_stops', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('town_name')->unique();
            $table->float('kilometers')->nullable();
            $table->float('price');

            $table->boolean('is_active')->default(true);
            $table->integer('added_by_id')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        \App\Models\BusStop::create([
            'town_name' => 'Fiapre',
            'kilometers' => 15.00,
            'price' => 5.00,
            'added_by_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_stops');
    }
};
