<?php

namespace App\Models;

use App\Models\ValueObject\QuestionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModerationLog extends Model
{
    /** @use HasFactory<\Database\Factories\ModerationLogFactory> */
    use HasFactory;

    protected $fillable = [
        'details',
        'question_id',
        'reason_id',
        'moderator_id',
        'previous_status',
        'new_status'
    ];

    protected function casts(): array
    {
        return [
            'previous_status' => QuestionStatus::class,
            'new_status' => QuestionStatus::class,
        ];
    }

    /**
     * RELATIONS
     */

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function reason(): BelongsTo
    {
        return $this->belongsTo(ModerationReason::class);
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
