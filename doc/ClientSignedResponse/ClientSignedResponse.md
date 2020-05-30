# ClientSignedResponse

### Ejemplo \#1. Crear una respuesta firmada, a partir de un array

```php
<?php

$signedResponse = new Sdk\ClientSignedResponse([
    'Client' => 'Nombre-Cliente',
    'I18NErrorMessages' => [
        'OK' => 'OK',
    ],
    'ResultCode' => 0,
    'ErrorMessage' => 'OK',
]);
$signedResponse->sign($priv);
echo $signedResponse;
```

### Ejemplo \#2. Crear una respuesta firmada, a partir de un array y sobrescribir el atributo Client.

```php
<?php

$signedResponse = new Sdk\ClientSignedResponse($array);
$signedResponse->setClient('Nombre-Cliente');
$signedResponse->sign($priv);
echo $signedResponse;
```

### Ejemplo \#3. Firmar una instancia de PlexoException

```php
<?php

$exc = new Sdk\Exception\ResultCodeException('Missing Fields.', Sdk\ResultCode::MISSING_FIELDS);
$signedResponse = new Sdk\ClientSignedResponse($exc);
$signedResponse->setClient('Nombre-Cliente');
$signedResponse->sign($priv);
echo $signedResponse;
```
