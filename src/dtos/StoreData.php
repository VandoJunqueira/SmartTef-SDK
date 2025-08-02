<?php

namespace SmartTef\dtos;

class StoreData extends BaseDTO
{

    public function __construct(
        public readonly ?string $name,
        public readonly ?string $trademark,
        public readonly ?string $contact_tel,
        public readonly ?string $city,
        public readonly ?string $uf,
        public readonly ?string $disctrict,
        public readonly ?string $address,
        public readonly ?string $zip_code,
        public readonly ?WebhookData $webhookUrl,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            trademark: $data['trademark'] ?? null,
            contact_tel: $data['contact_tel'] ?? null,
            city: $data['city'] ?? null,
            uf: $data['uf'] ?? null,
            disctrict: $data['disctrict'] ?? null,
            address: $data['address'] ?? null,
            zip_code: $data['zip_code'] ?? null,
            webhookUrl: !empty($data['webhookUrl']) && is_array($data['webhookUrl'])
                ? new WebhookData(
                    url: $data['webhookUrl']['url'] ?? null,
                    authorization_token: $data['webhookUrl']['authorization_token'] ?? null,
                )
                : null,
        );
    }
}
