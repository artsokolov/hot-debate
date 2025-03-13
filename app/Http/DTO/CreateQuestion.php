<?php

namespace App\Http\DTO;

readonly class CreateQuestion
{
    public function __construct(
        private string $question,
        private int $categoryId,
        private bool $stayAnonymous,
        private int $userId
    ) {}

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function isStayAnonymous(): bool
    {
        return $this->stayAnonymous;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
