<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_sample_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_sample_id')->constrained('training_samples')->cascadeOnDelete();
            $table->foreignId('criterion_id')->constrained('criteria')->cascadeOnDelete();
            $table->string('option_value')->nullable();
            $table->decimal('numeric_value', 8, 2)->nullable();
            $table->string('normalized_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_sample_details');
    }
};
