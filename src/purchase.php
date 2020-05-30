<?php
// Require the Composer autoloader.
require_once 'E:\githubGoova\1\Plexo.Client.SDK-PHP\vendor\autoload.php';

//PlexoClient client = new PlexoClient("FVidal", "fvidalTest.pfx", "fvidalTest", "http://209.133.212.155/plexodev-api/SecurePaymentGateway.svc"); //Desa nuevo
use Plexo\Sdk;
use Plexo\Sdk\Type;

//desa
$client = new Sdk\Client([
    'client' => 'Fvidal',
    'env' => 'test',
    'pfx_filename' => 'C:\Users\fvidal\workspace\PlexoSDK\resources\Fvidal_testing.pfx',
    'pfx_passphrase' => 'fvidalTest',
]);

//test
/*$client = new Sdk\Client([
    'client' => 'DAC',
    'env' => 'test',
    'pfx_filename' => 'C:\Users\fvidal\workspace\PlexoSDK\resources\DACTesting.pfx',
    'pfx_passphrase' => 'd4ck_t3st!',
]);*/
try {
    $response = $client->Purchase(['ClientReferenceId' => '342524',
        'CurrencyId' => Type\CurrencyType::UYU,
        'FinancialInclusion' => [
            'Type' => Type\InclusionType::NONE,
            'BilledAmount' => 439,
            'InvoiceNumber' => 19365817,
            //'InvoiceNumberStr' => 'A',  
            'TaxedAmount' => 439,
        ],
        'Installments' => 1,
        'Items' => [
            [
                'Amount' => 439,
                'ClientItemReferenceId' => '32157487',
            ],
        ],
        'OptionalCommerceId' => 84,
        'PaymentInstrumentInput' => [
            'InstrumentToken' => '58e3db85f3a44064b253906de380bb49',
            'NonStorableItems' => [
                'CVC' => '029'
            ],
            'OptionalInstrumentFields' => [
                new Type\FieldType(Type\FieldType::RECURRINGPAYMENT, 'true'),
                //new Type\FieldType(Type\FieldType::PLAN, '9'),
                new Type\FieldType(Type\FieldType::CYBERSOURCE_DEVICE_FINGERPRINT, 'prueba2108')
                //'CybersourceDeviceFingerprint' => ''
            ],
            
        ],
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
