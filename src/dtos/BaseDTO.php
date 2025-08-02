<?php

namespace SmartTef\dtos;

use BackedEnum;

abstract class BaseDTO
{
    /**
     * Converte o DTO para array removendo valores null e convertendo objetos DTO aninhados.
     */
    public function toArray(): array
    {
        return self::cleanArray(get_object_vars($this));
    }

    /**
     * Remove campos nulos de forma recursiva e converte objetos DTO para array.
     */
    protected static function cleanArray(array $array): array
    {
        return array_filter(
            array_map(function ($value) {
                if (is_array($value)) {
                    // Recursivamente limpa arrays
                    $cleaned = self::cleanArray($value);
                    return empty($cleaned) ? null : $cleaned;
                }

                if ($value instanceof BackedEnum) {
                    // Converte enum para seu valor primitivo
                    return $value->value;
                }

                if (is_object($value) && method_exists($value, 'toArray')) {
                    // Converte DTO aninhado para array e limpa
                    $cleaned = $value->toArray();
                    return empty($cleaned) ? null : $cleaned;
                }
                return $value;
            }, $array),
            fn($val) => !is_null($val)
        );
    }
}
