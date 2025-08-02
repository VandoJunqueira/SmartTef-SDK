<?php

namespace SmartTef\dtos;

class UserData extends BaseDTO
{
    public function __construct(
        public readonly ?string $email,
        public readonly ?string $name,
        public readonly string $user_type = 'OPER'
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'] ?? null,
            name: $data['name'] ?? null,
            user_type: $data['user_type'] ?? 'OPER',
        );
    }
}
