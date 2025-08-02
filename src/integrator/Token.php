<?php

namespace SmartTef\integrator;

use SmartTef\ApiConnection;

class Token
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function get(string $cnpj, string $cnpj_integrador)
    {
        return $this->http->post('/integrator/store/get/token', [
            'cnpj' => $cnpj,
            'cnpj_integrador' => $cnpj_integrador,
        ]);
    }

    public function revoke(string $cnpj)
    {
        return $this->http->post('/integrator/store/get/token', [
            'cnpj' => $cnpj,
        ]);
    }
}
