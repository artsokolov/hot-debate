<?php

namespace App\Models;

use App\Models\ValueObject\QuestionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property string $details
 * @property int $question_id
 * @property int $reason_id
 * @property int $moderator_id
 * @property QuestionStatus $previous_status
 * @property QuestionStatus $new_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $moderator
 * @property-read \App\Models\Question $question
 * @property-read \App\Models\ModerationReason $reason
 * @method static \Database\Factories\ModerationLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereModeratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereNewStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog wherePreviousStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
