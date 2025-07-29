<?php

namespace App\DTO;

class EmployeeDTO
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $first_name,
        public readonly string $last_name,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
        );
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }
}


