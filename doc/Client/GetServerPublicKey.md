# GetServerPublicKey

> public *array* **Plexo\\Sdk\\Client::GetServerPublicKey** ( *string* $fingerprint )

## Parámetros

**$fingerprint** (string) Fingerprint del certificado que se desea obtener.

## Valores devueltos

(array)

## Ejemplo

```php
<?php

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();
$response = $client->GetServerPublicKey('AEA4D5C586983A140F8B566EA81901E8BD8F8C9F');
print_r($response);
```

**Imprime**
```
Array
(
    [Fingerprint] => AEA4D5C586983A140F8B566EA81901E8BD8F8C9F
    [Key] => MIIEqjCCApKgAwIBAgIQAJWa99PYfAz1RXGI9lIkQzANBgkqhkiG9w0BAQ0FADAQMQ4wDA…
```

### Ver también

* [Certificate\\Certificate::fromServerPublicKey](Certificate/fromServerPublicKey.md)
