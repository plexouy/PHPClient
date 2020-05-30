# GetCommerceIssuers

> public *array* **Plexo\\Sdk\\Client::GetCommerceIssuers** ( *array* $commerce )

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->GetCommerceIssuers([
        'CommerceId' => 80
    ]);
    print_r($response);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```

### Imprime

```
Array
(
    [0] => Plexo\Sdk\Models\IssuerData Object
        (
            [IssuerId] => 4
            [CommerceId] => 9
            [Metadata] => Array
                (
                    [ProviderCommerceNumber] => 12345678
                )

        )

    [1] => Plexo\Sdk\Models\IssuerData Object
        (
            [IssuerId] => 11
            [CommerceId] => 9
            [Metadata] => Array
                (
                )

        )

    [2] => Plexo\Sdk\Models\IssuerData Object
        (
            [IssuerId] => 13
            [CommerceId] => 9
            [Metadata] => Array
                (
                )

        )

    [3] => Plexo\Sdk\Models\IssuerData Object
        (
            [IssuerId] => 15
            [CommerceId] => 9
            [Metadata] => Array
                (
                )

        )

    [4] => Plexo\Sdk\Models\IssuerData Object
        (
            [IssuerId] => 18
            [CommerceId] => 9
            [Metadata] => Array
                (
                    [ProviderCommerceNumber] => 87654321
                )

        )

)
```
