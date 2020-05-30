# Plexo SDK para PHP

[![Build Status](https://travis-ci.org/BuiltByBROS/plexo-sdk-php.svg?branch=master)](https://travis-ci.org/BuiltByBROS/plexo-sdk-php)

**Plexo** es un repositorio de medios de pago. Su objetivo es facilitar la utilización de estos instrumentos permitiendo desacoplar toda
complejidad asociada a la integración con los medios de pago.

## Requerimientos

Para correr el SDK, su sistema debe contar con **PHP >= 5.6** compilado con el módulo openssl.

## Primeros pasos

* Obtener nombre de usuario y certificado emitido por Plexo.
* [Instalar el SDK](#instalación).
* [Definir almacenamiento de certificados](#certificados).
* [Fijar credenciales](#credenciales).

## Instalación

Instalando el SDK vía Composer.

```bash
$ composer require plexouy/plexo-sdk
```

## Certificados

El cliente puede desarrollar y registrar su propia clase de almacenamiento de certificados. Esta clase debe implementar la interfaz *[Plexo\\Sdk\\Certificate\\CertificateStoreInterface](src/Certificate/CertificateProviderInterface.php)*.

De esta manera se evitará la realización de peticiones adicionales a la API, dándole al cliente la libertad de optar por el modo y lugar de almacenamiento más conveniente para él (base de datos, sistema de archivos, APIs, etc).

[Ver ejemplo](doc/CertificateProvider/example.md)

### La clase Plexo\\Sdk\\Certificate\\Certificate

Representa un certificado, conteniendo su fingerprint, clave pública y/o clave privada.

* **fingerprint** (string) SHA1 en hexadecimal.
* **cert** (string) Clave pública en Base 64, conteniendo las declaraciones "-----BEGIN CERTIFICATE-----" y "-----END CERTIFICATE-----".
* **pkey**  (string) Clave privada en Base 64, conteniendo las declaraciones "-----BEGIN PRIVATE KEY-----" y "END PRIVATE KEY".

## Credenciales

La autenticación se realiza a través de un nombre de usuario y verificación de firmas. Todas las peticiones son firmadas utilizando una clave privada emitida por Plexo.

**Nombre de usuario**

El nombre de usuario puede ser configurado fijando la variable de entorno *PLEXO_CREDENTIALS_CLIENT* o indicado en el código al instanciar la clase *Plexo\\Sdk\\Client* con la opción *client*.

**Clave privada**

La configuración de la clave privada puede realizarse de las siguientes tres maneras, tanto como variables de entorno o en el código al instanciar la clase *Plexo\\Sdk\\Client*:

**Opción 1. Fingerprint**: Si ha registrado su clase de almacenamiento de certificados, el SDK consultará el método *getByFingerprint*, pasando como parámetro el fingerprint, para obtener la clave privada almacenada. Su clase debe retornar un objeto del tipo *Plexo\\Sdk\\Certificate\\Certificate* conteniendo la clave privada extraída del archivo pfx.

* Variable de entorno:
    * *PLEXO_CREDENTIALS_PRIVKEY_FINGERPRINT*
* Opción del constructor:
    * *privkey_fingerprint*

**Opción 2. PEM/Fingerprint**: Si la clave privada fue extraída del archivo pfx a un archivo pem, agregue la ruta del archivo pem y el SDK utilizará clave contenida.

* Variables de entorno:
    * *PLEXO_CREDENTIALS_PEM_FILENAME*
    * *PLEXO_CREDENTIALS_PRIVKEY_FINGERPRINT*
* Opción del constructor:
    * *pem_filename*
    * *privkey_fingerprint*

**Opcion 3. PFX/Passphase** (más lento): Si no ha extraído los datos del archivo pfx, puede indicar la ruta a ese archivo y su contraseña de instalación.

* Variables de entorno:
    * *PLEXO_CREDENTIALS_PFX_FILENAME*
    * *PLEXO_CREDENTIALS_PFX_PASSPHRASE*
* Opción del constructor:
    * *pfx_filename*
    * *pfx_passphrase*

##### Ejemplo: Utilizando variables de entorno.

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();
```

##### Ejemplo: Indicando credenciales al instanciar *Client*.

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client([
    'client' => $client_name,
    'pem_filename' => $pem_filename,
    'privkey_fingerprint' => $fingerprint,
]);
```

## Clase Plexo\\Sdk\\Client

### Métodos

* [__construct](doc/Client/construct.md)
* [Authorize](doc/Client/Authorize.md)
* [Blacklist](doc/Client/Blacklist.md)
* [Purchase](doc/Client/Purchase.md)
* [Cancel](doc/Client/Cancel.md)
* [StartReserve](doc/Client/StartReserve.md)
* [EndReserve](doc/Client/EndReserve.md)
* [Status](doc/Client/Status.md)
* [GetInstruments](doc/Client/GetInstruments.md)
* [DeleteInstrument](doc/Client/DeleteInstrument.md)
* [GetSupportedIssuers](doc/Client/GetSupportedIssuers.md)
* [GetCommerces](doc/Client/GetCommerces.md)
* [AddCommerce](doc/Client/AddCommerce.md)
* [ModifyCommerce](doc/Client/ModifyCommerce.md)
* [DeleteCommerce](doc/Client/DeleteCommerce.md)
* [SetDefaultCommerce](doc/Client/SetDefaultCommerce.md)
* [GetCommerceIssuers](doc/Client/GetCommerceIssuers.md)
* [AddIssuerCommerce](doc/Client/AddIssuerCommerce.md)
* [DeleteIssuerCommerce](doc/Client/DeleteIssuerCommerce.md)
* [GetProvidedCodeCommerce](doc/Client/GetProvidedCodeCommerce.md)
* [GetServerPublicKey](doc/Client/GetServerPublicKey.md)
