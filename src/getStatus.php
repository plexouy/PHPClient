<?php
// Require the Composer autoloader.
require_once 'E:\githubGoova\1\Plexo.Client.SDK-PHP\vendor\autoload.php';

//PlexoClient client = new PlexoClient("FVidal", "fvidalTest.pfx", "fvidalTest", "http://209.133.212.155/plexodev-api/SecurePaymentGateway.svc"); //Desa nuevo
use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client([
    'client' => 'Fvidal',
    'pfx_filename' => 'C:\Users\fvidal\workspace\PlexoSDK\resources\Fvidal_testing.pfx',
    'pfx_passphrase' => 'fvidalTest',
]);

try {
    $response = $client->Status([
        'Type' => Type\ReferenceType::PLEXO_TRANSACTION_ID,
        //'Type' => Type\ReferenceType::CLIENT_PURCHASE_REFERENCE_ID,
        //'MetaReference' => '72352'
        'MetaReference' => '812ad30338144a3ebf264653a69a619c'
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
