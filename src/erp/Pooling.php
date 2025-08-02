<?php

namespace SmartTef\erp;

use SmartTef\ApiConnection;

class Pooling
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function order($datetimeInitial, $datetimeFinal)
    {
        return $this->http->post('/pooling/order', [
            'datetimeInitial' => $datetimeInitial,
            'datetimeFinal' => $datetimeFinal
        ]);
    }
}
