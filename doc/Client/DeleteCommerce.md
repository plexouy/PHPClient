# DeleteCommerce

> public *void* **Plexo\\Sdk\\Client::DeleteCommerce** ()

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->DeleteCommerce([
        'CommerceId' => 80
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
