# CodeAction

> public *Plexo\\Sdk\\Models\\Transaction* **Plexo\\Sdk\\Client::CodeAction** ( *array* $payment )

## Parámetros

  * **Code** *string*
  * **Action** *int*

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();
try {
    $response = $client->CodeAction([
        'Code' => 'code',
        'Action' => Models\CodeRequest::CODE_ACTION_QUERY,
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
```
