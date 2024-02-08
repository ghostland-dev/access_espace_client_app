<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('compteurgazs', function (Blueprint $table) {
            $table
                ->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compteurgazs', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
        });
    }
};
