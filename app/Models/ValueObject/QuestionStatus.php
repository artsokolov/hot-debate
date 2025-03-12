<?php

namespace App\Models\ValueObject;

enum QuestionStatus: string
{
    case ON_MODERATION = 'moderation';
    case PUBLISHED = 'published';
    case REJECTED = 'rejected';
    case CLOSED = 'closed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
