# ModifyCommerce

> public *Plexo\\Sdk\\Models\\Commerce* **Plexo\\Sdk\\Client::ModifyCommerce** ( *array* $commerce )

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->ModifyCommerce([
        'CommerceId' => 80,
        'Name' => 'Nuevo nombre'
    ]);
    printf("ID: %d, Nombre: %s\n", $commerce->CommerceId, $commerce->Name);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```

### Imprime

```
ID: 80, Nombre: Nuevo nombre
```
