<?php

namespace SmartTef\erp;

use SmartTef\ApiConnection;
use SmartTef\dtos\UserData;

class Users
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function list()
    {
        return $this->http->get('/manager/users/get');
    }

    public function create(UserData $userData)
    {
        return $this->http->post('/manager/user/create', $userData->toArray());
    }

    public function block(string $email)
    {
        return $this->http->post('/manager/user/block', ['email' => $email]);
    }

    public function updatePosPassword(string $email)
    {
        return $this->http->post('/manager/user/update/pos/password', ['email' => $email]);
    }

    public function updatePassword(string $email, string $password)
    {
        return $this->http->post('/manager/user/update/password', ['email' => $email, 'password' => $password]);
    }
}
