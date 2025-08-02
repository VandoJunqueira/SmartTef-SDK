<?php

declare(strict_types=1);

namespace SmartTef;

use SmartTef\erp\OrderPayment;
use SmartTef\erp\Pooling;
use SmartTef\erp\Printing;
use SmartTef\erp\Store;
use SmartTef\erp\Terminals;
use SmartTef\erp\Users;
use SmartTef\integrator\CreateStore;
use SmartTef\integrator\Token;

/**
 * Vando Junqueira - https://github.com/VandoJunqueira
 * Classe para interação do SmartTEF.
 *
 * @property CreateStore   $createStore
 * @property Token         $token
 * @property Users         $users
 * @property Store         $store
 * @property Pooling       $pooling
 * @property Terminals     $terminals
 * @property Printing      $printing
 * @property OrderPayment  $orderPayment
 */
class SmartTEF
{
    private object $http;

    /**
     * Mapeamento das propriedades acessadas dinamicamente.
     *
     * @var array
     */
    private array $classes = [
        'createStore'   => CreateStore::class,
        'token'         => Token::class,
        'users'         => Users::class,
        'store'         => Store::class,
        'pooling'       => Pooling::class,
        'terminals'     => Terminals::class,
        'printing'      => Printing::class,
        'orderPayment'  => OrderPayment::class,
    ];

    public function __construct(?object $http = null)
    {
        // Usa a instância fornecida ou tenta detectar o ambiente automaticamente
        if ($http) {
            $this->http = $http;
        } elseif (class_exists(\Illuminate\Support\Facades\Http::class)) {
            $this->http = new ApiConnection();
        } else {
            $this->http = new ApiConnectionCurl();
        }
    }

    public function setAuthorization(string $token, string $subscriptionKey): void
    {
        $this->http->setAuthorization($token, $subscriptionKey);
    }

    public function __get($name)
    {
        if (\array_key_exists($name, $this->classes)) {
            $class = $this->classes[$name];
            return new $class($this->http);
        }

        return null;
    }
}
