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
        Schema::create('label_note', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBiginteger('label_id');
            $table->unsignedBiginteger('note_id');

            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_note');
    }
};
