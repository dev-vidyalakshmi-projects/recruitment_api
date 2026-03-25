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
       Schema::create('interviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->foreignId('stage_id')->constrained('interview_stages')->onDelete('cascade');

            $table->dateTime('scheduled_at')->nullable();
            $table->string('mode')->nullable(); // online / offline
            $table->text('feedback')->nullable();

            $table->enum('result', ['pending', 'pass', 'fail'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
