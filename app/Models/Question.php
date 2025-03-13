<?php

namespace App\Models;

use App\Models\ValueObject\QuestionStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string $status
 * @property int $category_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\QuestionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Question whereUserId($value)
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vote> $votes
 * @property-read int|null $votes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModerationLog> $moderationLogs
 * @property-read int|null $moderation_logs_count
 * @method static Builder<static>|Question published()
 * @method static Builder<static>|Question withinDay()
 * @mixin \Eloquent
 */
class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    private const RESTRICTION_PER_DAY = 10;

    protected $fillable = [
        'title',
        'status',
        'category_id',
        'is_anonymous',
        'user_id'
    ];

    protected $attributes = [
        'status' => QuestionStatus::ON_MODERATION
    ];

    protected function casts(): array
    {
        return [
            'status' => QuestionStatus::class,
        ];
    }

    /**
     * METHODS
     */

    public static function exceedingLimit(int $userId): bool
    {
        return self::whereUserId($userId)->withinDay()->count() >= self::RESTRICTION_PER_DAY;
    }

    public function isPublic(): bool
    {
        return $this->status == QuestionStatus::PUBLISHED;
    }

    /**
     * Relations
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function moderationLogs(): HasMany
    {
        return $this->hasMany(ModerationLog::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * SCOPES
     */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', QuestionStatus::PUBLISHED);
    }

    public function scopeWithinDay(Builder $query): Builder
    {
        return $query->where('created_at', '>', now()->subDay());
    }
}
