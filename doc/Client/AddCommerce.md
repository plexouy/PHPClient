# AddCommerce

> public *\\Plexo\\Sdk\\Models\\Commerce* **Plexo\\Sdk\\Client::AddCommerce** ( *array* $commerce )

## Parámetros

**$commerce** (array)

  * **Name** (string) Nombre del comercio

## Retorno

\\Plexo\\Sdk\\Models\\Commerce

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $commerce = $client->AddCommerce([
        'Name' => 'Nombre Comercio',
    ]);
    printf("ID: %d, Nombre: %s\n", $commerce->CommerceId, $commerce->Name);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```

### Imprime

```
ID: 13, Nombre: Nombre Comercio
```
