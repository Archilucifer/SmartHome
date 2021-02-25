<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    private const TABLE_NAME = 'rooms';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', [
                'BedRoom',
                'BathRoom',
                'LivingRoom',
                'Study',
                'Kitchen',
                'DiningRoom',
                'Hall',
                'Corridor',
                'Attic',
                'Garage',
                'Yard',
            ]);
            $table->integer('home')->unsigned();

            $table->foreign('home')->references('id')->on('homes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop(self::TABLE_NAME);
    }
}
