# StartReserve

> public *Plexo\\Sdk\\Models\\Transaction* **Plexo\\Sdk\\Client::StartReserve** ( *array* $payment )

## Parámetros

  * **ExpirationUTC** *int*
  * **ClientReferenceId** *string*
  * **PaymentInstrumentInput** (PaymentInstrumentInput)
  * **Items** array(Item)
  * **CurrencyId** *int*
  * **Installments** *int*
  * **FinancialInclusion** *FinancialInclusion* Campo para enviar información sobre la Ley de Inclusión Financiera, que contiene:
      * BilledAmount
      * InvoiceNumber
      * TaxedAmount
      * Type
  * **TipAmount** *float* Opcional
  * **OptionalCommerceId** *int* Opcional
  * **OptionalMetadata** *string*

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();
try {
    $response = $client->StartReserve([
        'ClientReferenceId' => 'asd',
        'CurrencyId' => Sdk\Type\CurrencyType::UYU,
        'ExpirationUTC' => (time() + 3600),
        'FinancialInclusion' => [
            'BilledAmount'  => 123456,
            'InvoiceNumber' => 987654321,
            'TaxedAmount'   => 123455,
            'Type'          => 1,
        ],
        'Installments' => 456,
        'Items' => [
            [
                'Amount' => 100.0,
                'ClientItemReferenceId' => '12345',
            ]
        ],
        'PaymentInstrumentInput' => [
            'InstrumentToken' => 'd3052dd3810044d9a4091bd5281157b2'
        ],
        'TipAmount' => 2.3456,
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
```
