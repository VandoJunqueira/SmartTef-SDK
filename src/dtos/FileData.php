<?php

namespace SmartTef\dtos;

class FileData extends BaseDTO
{
    public function __construct(
        public readonly ?string $data,
    ) {}
}
