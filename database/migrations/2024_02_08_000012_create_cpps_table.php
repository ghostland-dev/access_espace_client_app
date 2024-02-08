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
        Schema::create('cpps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fichier');
            $table->boolean('signe')->default(false);
            $table->unsignedBigInteger('contact_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpps');
    }
};
