<?php

namespace SmartTef\dtos;

class OrderPaymentData extends BaseDTO
{
    public function __construct(
        public readonly ?float $value,
        public readonly ?string $payment_type,
        public readonly ?string $charge_id,
        public readonly ?string $serial_pos,
        public readonly ?int $installments = 1,
        public readonly ?string $order_type = 'CRD_UNICO',
        public readonly ?OrderExtrasData $extras = null,
        public readonly ?int $user_id = null,
        public readonly ?string $fee_type = null,
        public readonly ?bool $has_details = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            value: $data['value'] ?? null,
            payment_type: $data['payment_type'] ?? null,
            installments: $data['installments'] ?? null,
            charge_id: $data['charge_id'] ?? null,
            order_type: $data['order_type'] ?? null,
            extras: isset($data['extras']) && is_array($data['extras'])
                ? new OrderExtrasData(
                    CPF: $data['extras']['CPF'] ?? null,
                    Nome: $data['extras']['Nome'] ?? null
                )
                : null,
            serial_pos: $data['serial_pos'] ?? null,
            user_id: $data['user_id'] ?? null,
            fee_type: $data['fee_type'] ?? null,
            has_details: $data['has_details'] ?? null,
        );
    }
}
