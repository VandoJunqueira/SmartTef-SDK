<?php

namespace SmartTef\dtos;

class WebhookData extends BaseDTO
{
    public function __construct(
        public readonly ?string $url,
        public readonly ?string $authorization_token
    ) {}
}
