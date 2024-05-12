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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiztitle_id');
            $table->string('question');
            $table->string('choicesA');
            $table->string('choicesB');
            $table->string('choicesC');
            $table->string('choicesD');
            $table->string('choicesE');
            $table->string('answer');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('quiztitle_id')->references('id')->on('quiz_titles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
