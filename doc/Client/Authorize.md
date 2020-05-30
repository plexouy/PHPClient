# Authorize

El llamado a este servicio WEB se hace desde el servidor del comercio y es el primer paso que se debe dar para interactuar con Plexo,
obteniendo como resultado una sesión de usuario.

> public *string* **Plexo\\Sdk\\Client::Authorize** ( *array* $auth )

## Parámetros

**$auth** (array)

  * **AuthorizationType** (int) Una de las constantes de *Plexo\\Sdk\\Type\\AuthorizationType:*
    * CLIENT_REFERENCE
    * OAUTH
    * ANONYMOUS
  * **MetaReference** (string)
  * **ActionType** (int) Máscara de bits formada con las constantes de *Plexo\\Sdk\\Type\\ActionType*:
    * SELECT_INSTRUMENT
    * REGISTER_INSTRUMENT
    * DELETE_INSTRUMENT
    * SESSION_EXTEND_AMOUNT
    * CLIENT_EXTEND_AMOUNT
  * **RedirectUri** (string)
  * **OptionalMetadata** *opcional* *string*
  * **ClientInformation** *opcional* (array)
  * **DoNotUseCallback** *bool*
  * **LimitIssuers** *opcional*
  * **PromotionInfoIssuers** *opcional*
  * **ExtendableInstrumentToken** (opcional)

## Valores devueltos

(array) Información de sesión.

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();

try {
    $response = $client->Authorize([
        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
        'Type' => Type\AuthorizationType::ANONYMOUS,
        'MetaReference' => '123456',
        'RedirectUri' => 'http://www.sitiocliente.com/plexo/XXX/YYY',
        'ClientInformation' => [
            new Type\FieldType(Type\FieldType::IDENTIFICATION_TYPE, Type\FieldType::IDENTIFICATION_TYPE_CI),
            new Type\FieldType(Type\FieldType::IDENTIFICATION, '11111111'),
            new Type\FieldType(Type\FieldType::EMAIL, 'mail@dominio.com'),
        ],
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
    [Id] => 0123456789abcdef0123456789abcdef
    [Uri] => http://plexo.com.uy/plexoweb/Instruments/Chose?sessionid=0123456789abcdef0123456789abcdef
    [ExpirationUTC] => 1504490598
)
```
