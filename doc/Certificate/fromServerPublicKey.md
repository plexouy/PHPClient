# fromServerPublicKey

Instancia un certificado a partir de la respuesta obtenida de [Plexo\\Sdk\\Client::GetServerPublicKey](Client/GetServerPublicKey.md).

> public static *Plexo\\Sdk\\Certificate\\Certificate* **Plexo\\Sdk\\Certificate\\Certificate::fromServerPublicKey** ( *string* $key, [ *string* $fingerprint ] )

## Ejemplo

```php
<?php

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();
$response = $client->GetServerPublicKey('AEA4D5C586983A140F8B566EA81901E8BD8F8C9F');

$cert = Sdk\Certificate\Certificate::fromServerPublicKey($response['Key'], $response['Fingerprint']);

```
