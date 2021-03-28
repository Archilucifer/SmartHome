<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    private const TABLE_NAME = 'homes';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['flat','country']);
            $table->integer('owner')->unsigned();
            $table->boolean('main')->default(false);

            $table->foreign('owner')->references('id')->on('users');
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
