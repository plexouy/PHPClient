# GetCommerces

> public *array* **Plexo\\Sdk\\Client::GetCommerces** ()

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->GetCommerces();
    print_r($response);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```

### Imprime

```
Array
(
    [0] => Plexo\Sdk\Models\Commerce Object
        (
            [CommerceId] => 9
            [Name] => Comercio A
        )

    [1] => Plexo\Sdk\Models\Commerce Object
        (
            [CommerceId] => 13
            [Name] => Comercio B
        )

)
```
