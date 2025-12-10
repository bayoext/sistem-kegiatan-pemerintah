<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Perencanaan', 'Berjalan', 'Selesai', 'Dibatalkan'])->default('Perencanaan');
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('location')->nullable();
            $table->string('thumbnail')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
