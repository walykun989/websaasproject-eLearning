<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('private_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajar_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('course_id')->nullable()->constrained();
            $table->string('title');
            $table->timestamp('scheduled_at');
            $table->unsignedInteger('duration_minutes')->default(60);
            $table->string('meeting_link')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('private_sessions');
    }
};
