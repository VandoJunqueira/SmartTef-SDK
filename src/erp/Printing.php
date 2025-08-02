<?php

namespace SmartTef\erp;

use SmartTef\ApiConnection;
use SmartTef\dtos\PrintingData;

class Printing
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function create(PrintingData $printingData)
    {
        return $this->http->post('/commands/print/create', $printingData->toArray());
    }

    public function cancel(string $print_identifier)
    {
        return $this->http->post('/commands/print/status/cancelar', [
            'print_identifier' => $print_identifier
        ]);
    }

    public function status(string $print_identifier)
    {
        return $this->http->post('/pooling/print/get', [
            'print_identifier' => $print_identifier
        ]);
    }
}
