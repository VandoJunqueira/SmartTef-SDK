<?php

namespace SmartTef\integrator;

use SmartTef\ApiConnection;
use SmartTef\dtos\CreateStoreData;

class CreateStore
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function handle(CreateStoreData $data)
    {
        return $this->http->post('/integrator/store/active', $data->toArray());
    }
}
