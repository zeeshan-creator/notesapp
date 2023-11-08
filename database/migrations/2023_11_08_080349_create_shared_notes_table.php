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
        Schema::create('shared_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('note_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('shared_to');
            $table->timestamps();

            $table->foreign('note_id')->references('id')->on('notes');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('shared_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_notes');
    }
};
