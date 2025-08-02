<?php

namespace SmartTef\erp;

use SmartTef\ApiConnection;

class Terminals
{
    private $http;

    public function __construct(ApiConnection $connection)
    {
        $this->http = $connection;
    }

    public function list()
    {
        return $this->http->get('/manager/terminals/get');
    }

    public function nickname(string $serial_pos, string $nickname)
    {
        return $this->http->post('/manager/terminals/nickname', [
            'serial_pos' => $serial_pos,
            'nickname' => $nickname,
        ]);
    }

    public function block(string $serial_pos)
    {
        return $this->http->post('/manager/terminals/block', [
            'serial_pos' => $serial_pos,
        ]);
    }

    public function unblock(string $serial_pos)
    {
        return $this->http->post('/manager/terminals/unblock', [
            'serial_pos' => $serial_pos,
        ]);
    }
}
