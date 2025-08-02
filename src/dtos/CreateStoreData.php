<?php

namespace SmartTef\dtos;

use Illuminate\Http\Request;

class CreateStoreData extends BaseDTO
{
    public function __construct(
        public readonly ?string $cnpj,
        public readonly ?string $cnpj_integrador,
        public readonly ?string $email,
        public readonly ?string $password,
        public readonly ?string $name,
        public readonly ?string $store_name
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cnpj: $data['cnpj'] ?? null,
            cnpj_integrador: $data['cnpj_integrador'] ?? null,
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
            name: $data['name'] ?? null,
            store_name: $data['store_name'] ?? null,
        );
    }
}
