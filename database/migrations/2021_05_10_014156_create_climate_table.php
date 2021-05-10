<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimateTable extends Migration
{
    private const TABLE_NAME = 'climate';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('temp')->unsigned();
            $table->integer('humidity')->unsigned();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::drop(self::TABLE_NAME);
    }
}
