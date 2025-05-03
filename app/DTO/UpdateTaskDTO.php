<?php

namespace App\DTO;

class UpdateTaskDTO
{
    public function __construct(
        private ?string $title = null,
        private ?string $description = null,
        private ?string $status = null
    ){}

    public function toArray(): array
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ], fn($value) => $value !== null);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

}
