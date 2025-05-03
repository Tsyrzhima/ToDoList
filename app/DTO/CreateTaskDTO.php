<?php

namespace App\DTO;

class CreateTaskDTO
{
    public function __construct(
        private string $title,
        private ?string $description = null ,
        private ?string $status = 'pending'
    ){}

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

}
