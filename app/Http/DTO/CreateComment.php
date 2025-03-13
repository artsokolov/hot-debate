<?php

namespace App\Http\DTO;

class CreateComment
{
    public function __construct(
        private string $content,
        private int $questionId,
        private int $userId,
        private ?int $parentId = null,
    ) {}

    public function getContent(): string
    {
        return $this->content;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }
}
