# DeleteInstrument

> public *string* **Plexo\\Sdk\\Client::DeleteInstrument** ( *array* $info )

## Parámetros

**$info** (array)

  * **Type** (int) Una de las constantes de *Plexo\\Sdk\\Type\\AuthorizationType*
  * **InstrumentToken** (string)
  * **MetaReference** (string)

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->DeleteInstrument([
        'Type' => Type\AuthorizationType::ANONYMOUS,
        'InstrumentToken' => 'asd',
        'MetaReference' => 'asd',
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
