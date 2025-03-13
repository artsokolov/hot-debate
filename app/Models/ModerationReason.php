<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModerationReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModerationReason extends Model
{
    protected $fillable = ['name'];
}
