<?php

namespace SmartTef\dtos;

class OrderExtrasData extends BaseDTO
{
    public function __construct(
        public readonly ?string $CPF,
        public readonly ?string $Nome,
    ) {}
}
