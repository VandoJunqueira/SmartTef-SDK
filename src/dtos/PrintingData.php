<?php

namespace SmartTef\dtos;

class PrintingData extends BaseDTO
{
    public function __construct(
        public readonly ?string $order_type,
        public readonly ?bool $has_details,
        public readonly ?string $print_id,
        public readonly ?string $serial_pos = null,
        public readonly ?int $user_id = null,
        public readonly ?FileData $file,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            order_type: $data['order_type'] ?? null,
            has_details: $data['has_details'] ?? null,
            print_id: $data['print_id'] ?? null,
            serial_pos: $data['serial_pos'] ?? null,
            user_id: $data['user_id'] ?? null,
            file: isset($data['file']) && is_array($data['file'])
                ? new FileData(
                    data: $data['file']['data'] ?? null
                )
                : null
        );
    }
}
