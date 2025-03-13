<?php

use App\Models\ValueObject\QuestionStatus;
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
        Schema::create('moderation_logs', function (Blueprint $table) {
            $statuses = QuestionStatus::values();

            $table->id();
            $table->text('details');
            $table->foreignId('question_id')->constrained('questions');
            $table->foreignId('reason_id')->constrained('moderation_reasons');
            $table->foreignId('moderator_id')->constrained('users');
            $table->enum('previous_status', $statuses);
            $table->enum('new_status', $statuses);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderation_logs');
    }
};
