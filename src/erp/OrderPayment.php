<?php

namespace SmartTef\erp;

use SmartTef\ApiConnection;
use SmartTef\dtos\OrderPaymentData;

class OrderPayment
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function create(OrderPaymentData $orderPaymentData)
    {
        return $this->http->post('/commands/order/create', $orderPaymentData->toArray());
    }

    public function status(string $payment_identifier)
    {
        return $this->http->post('/pooling/order/get', [
            'payment_identifier' => $payment_identifier
        ]);
    }

    public function cancel(string $payment_identifier)
    {
        return $this->http->post('/commands/order/status/cancelar', [
            'payment_identifier' => $payment_identifier
        ]);
    }

    public function reverse(string $payment_identifier)
    {
        return $this->http->post('/commands/order/status/estornar', [
            'payment_identifier' => $payment_identifier
        ]);
    }
}
