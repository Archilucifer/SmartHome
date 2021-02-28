<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    private const TABLE_NAME = 'devices';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('name');
            $table->string('icon_class');
            $table->integer('room')->unsigned();
            $table->integer('home')->unsigned();

            $table->foreign('room')->references('id')->on('rooms');
            $table->foreign('home')->references('id')->on('homes');
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
