# Status

> public *string* **Plexo\\Sdk\\Client::Status** ( *array* $payment )

## Parámetros

**$auth** (array)

  * **Type** (int) Una de las constantes de *Plexo\\Sdk\\Type\\ReferenceType:*
    * PLEXO_TRANSACTION_ID
    * CLIENT_PURCHASE_REFERENCE_ID
    * CLIENT_CANCEL_REFERENCE_ID
    * CLIENT_RESERVE_REFERENCE_ID
  * **MetaReference** (string)

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->Status([
        'Type' => Type\ReferenceType::PLEXO_TRANSACTION_ID,
        'MetaReference' => '123456'
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
