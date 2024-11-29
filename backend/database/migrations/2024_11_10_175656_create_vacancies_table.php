<?php

use App\Models\Vacancy;
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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('description');
            $table->string('field');
            $table->enum('category', [Vacancy::PRESENCIAL_CATEGORY, Vacancy::HOMEOFFICE_CATEGORY, Vacancy::HYBRID_CATEGORY]);
            $table->string('location');
            $table->string('image')->nullable();
            $table->boolean('active');
            $table->string('company');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccacions');
    }
};
