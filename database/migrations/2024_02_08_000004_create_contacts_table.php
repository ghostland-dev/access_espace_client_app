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
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('civilite');
            $table->string('nom');
            $table->string('prenom');
            $table->string('fonction');
            $table->string('mobile');
            $table->string('fix');
            $table->boolean('signataire');
            $table->boolean('decisionnaire');
            $table->unsignedBigInteger('site_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
