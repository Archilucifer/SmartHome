<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditDevicesAddMacAddress extends Migration
{
    private const TABLE_NAME = 'devices';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::table(self::TABLE_NAME, static function (Blueprint $table) {
            $table->string('mac', 17)->nullable();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, static function (Blueprint $table) {
            $table->dropColumn('mac');
        });
    }
}
