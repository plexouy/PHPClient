<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class CodeRequestTest extends TestCase
{
    public function testFromArray()
    {
        $codeRequest = Models\CodeRequest::fromArray([
            'Code' => 'code',
            'Action' => Models\CodeRequest::CODE_ACTION_QUERY,
        ]);
        $this->assertEmpty($codeRequest->validate());
        return $codeRequest;
    }

    /**
     * @depends testFromArray
     */
    public function testSignatureBaseString($codeRequest)
    {
        $signedRequest = new SignedRequest($codeRequest);
        $signedRequest->setClient('Prueba');
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Action":0,"Code":"code"}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
