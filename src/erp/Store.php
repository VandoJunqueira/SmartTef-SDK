<?php

namespace SmartTef\erp;

use SmartTef\ApiConnection;
use SmartTef\dtos\StoreData;
use SmartTef\dtos\UserData;

class Store
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function update(StoreData $storeData)
    {
        return $this->http->post('/manager/store/update', $storeData->toArray());
    }

    public function info()
    {
        return $this->http->get('/manager/store/get');
    }

    public function updateConfig(string $name, mixed $value)
    {
        return $this->http->post('/manager/store/config', [
            'name' => $name,
            'value' => $value,
        ]);
    }

    public function getConfig()
    {
        return $this->http->get('/manager/store/config/get');
    }
}
