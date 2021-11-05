<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClimatesChangeClimatesTypes extends Migration
{
    private const TABLE_NAME = 'climates';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(self::TABLE_NAME, static function (Blueprint $table) {
            $table->decimal('temp', 2, 1)->change();
            $table->decimal('humidity', 2, 1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, static function (Blueprint $table) {
            $table->unsignedInteger('temp')->change();
            $table->unsignedInteger('humidity')->change();
        });
    }
}
