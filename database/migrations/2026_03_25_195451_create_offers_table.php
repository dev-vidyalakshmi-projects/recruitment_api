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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('application_id')->constrained()->onDelete('cascade');

            $table->decimal('salary', 10, 2)->nullable();
            $table->date('joining_date')->nullable();

            $table->enum('status', ['offered', 'accepted', 'declined'])->default('offered');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
