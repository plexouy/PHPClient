# GetInstruments

> public *void* **Plexo\\Sdk\\Client::GetInstruments** ( *array* $info )

## Parámetros

**$info**

  * **Type** *int* Una de las constantes *Plexo\Sdk\Type\AuthorizationType*
  * **Metadata** *string* (opcional)

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();

try {
    $response = $client->GetInstruments([
        'Type' => Type\AuthorizationType::ANONYMOUS,
        'Metadata' => 'metadata info',
    ]);
} catch (Exception $exc) {
    printf("[%s] (%s) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
```
