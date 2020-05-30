# AddIssuerCommerce

> public *void* **Plexo\\Sdk\\Client::AddIssuerCommerce** ( *array* $commerce )

## Parámetros

**$commerce**

  * **IssuerId** *int*
  * **CommerceId** *int*
  * **Metadata** *array* (opcional)

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

/* @var int */
$issuerId;

/* @var int */
$commerceId;

try {
    $response = $client->AddIssuerCommerce([
        'IssuerId' => $issuerId,
        'CommerceId' => $commerceId,
        'Metadata' => [
            'ProviderCommerceNumber' => $providerCommerceNumber,
        ]
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
