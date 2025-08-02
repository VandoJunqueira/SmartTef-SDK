# SmartTEF SDK

[![Latest Stable Version](https://poser.pugx.org/vandojunqueira/smarttef-sdk/v)](https://packagist.org/packages/vandojunqueira/smarttef-sdk)
[![License](https://poser.pugx.org/vandojunqueira/smarttef-sdk/license)](LICENSE)

SDK PHP para integração com a API do **SmartTEF**, compatível com **Laravel** e **PHP puro**, utilizando automaticamente a melhor conexão disponível (`Laravel Http` ou `cURL`).

---

## 📦 Instalação

Via [Composer](https://getcomposer.org):

composer require vandojunqueira/smarttef-sdk

---

## ⚙️ Requisitos

- PHP >= 8.0
- Laravel (opcional)

---

## 🧠 Detecção Automática

A biblioteca detecta automaticamente o ambiente:

- **Laravel**: usa `Illuminate\Support\Facades\Http` (via `ApiConnection`)
- **PHP puro**: usa `cURL` (via `ApiConnectionCurl`)

Você também pode forçar manualmente a conexão desejada, se necessário.

---

## 🚀 Exemplo de Uso

### Laravel

use SmartTef\SmartTEF;

$smartTef = new SmartTEF();
$smartTef->setAuthorization('seu_token', 'sua_subscription_key');

$response = $smartTef->token->gerar(); // Exemplo de uso

### PHP Puro

require 'vendor/autoload.php';

use SmartTef\SmartTEF;

$smartTef = new SmartTEF();
$smartTef->setAuthorization('seu_token', 'sua_subscription_key');

$response = $smartTef->store->listar(); // Exemplo de uso

---

## 🧩 Componentes disponíveis

| Propriedade    | Classe                   | Descrição                     |
| -------------- | ------------------------ | ----------------------------- |
| `createStore`  | `integrator\CreateStore` | Criação de lojas              |
| `token`        | `integrator\Token`       | Geração e renovação de tokens |
| `users`        | `erp\Users`              | Gestão de usuários            |
| `store`        | `erp\Store`              | Informações e ações da loja   |
| `pooling`      | `erp\Pooling`            | Pooling de transações         |
| `terminals`    | `erp\Terminals`          | Gerenciamento de terminais    |
| `printing`     | `erp\Printing`           | Impressão de comprovantes     |
| `orderPayment` | `erp\OrderPayment`       | Pagamento de pedidos          |

---

## 🛠️ Injeção Manual de Conexão

Você pode injetar a conexão diretamente:

use SmartTef\SmartTEF;
use SmartTef\ApiConnectionCurl;

$smartTef = new SmartTEF(new ApiConnectionCurl());

---

## 📁 Variáveis de Ambiente

Você pode configurar a SDK via `.env`:

SMART_TEF_API_BASE_URL=https://api.smarttef.com.br
SMART_TEF_API_TOKEN=seu_token
SMART_TEF_API_SUBSCRIPTION_KEY=sua_chave

---

## ✅ Licença

MIT © [Vando Junqueira](https://github.com/VandoJunqueira)
