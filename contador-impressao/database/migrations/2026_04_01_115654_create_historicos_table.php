<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('impressora_id');
            $table->foreign('impressora_id')->references('id')->on('impressoras')->onDelete('cascade');
            $table->unsignedBigInteger('leitura_id');
            $table->foreign('leitura_id')->references('id')->on('leitura')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historicos', function (Blueprint $table) {
            $table->dropForeign(['impressora_id']);
            $table->dropForeign(['leitura_id']);
        });
        Schema::dropIfExists('historicos');
    }
};