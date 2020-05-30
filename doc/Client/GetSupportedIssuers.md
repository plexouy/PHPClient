# GetSupportedIssuers

> public *array* **Plexo\\Sdk\\Client::GetSupportedIssuers** ( )

## Valores devueltos

(array) Lista de emisores.

## Ejemplo

```php
<?php

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();
$response = $client->GetSupportedIssuers();
print_r($response);
```

**Imprime**
```
Array
(
    [0] => Array
        (
            [Id] => 4
            [Issuer] => MasterCard
            [Bank] =>
            [Variation] =>
            [ImageUrl] => http://localhost/4.png
        )

    [1] => Array
        (
            [Id] => 11
            [Issuer] => Visa
            [Bank] =>
            [Variation] =>
            [ImageUrl] => http://localhost/11.png
        )

)
```
