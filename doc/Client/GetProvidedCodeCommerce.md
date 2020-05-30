# GetProvidedCodeCommerce

> public *Plexo\\Sdk\\Models\\Commerce* **Plexo\\Sdk\\Client::GetProvidedCodeCommerce** ( *array* $commerce )

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->GetProvidedCodeCommerce([
        'Name' => 'Nombre'
    ]);
    printf("ID: %d, Nombre: %s\n", $commerce->CommerceId, $commerce->Name);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
