<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class DeleteInstrumentRequestTest extends TestCase
{
    public function testFromArray()
    {
        $deleteInstrumentRequest = Models\DeleteInstrumentRequest::fromArray([
            'InstrumentToken' => 'token',
            'MetaReference' => 'meta reference',
            // 'Type' => Type\AuthorizationType::ANONYMOUS,
        ]);
        $this->assertEmpty($deleteInstrumentRequest->validate());
        return $deleteInstrumentRequest;
    }

    /**
     * @depends testFromArray
     */
    public function testSignatureBaseString($deleteInstrumentRequest)
    {
        $signedRequest = new SignedRequest($deleteInstrumentRequest);
        $signedRequest->setClient('Prueba');
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"InstrumentToken":"token","MetaReference":"meta reference","Type":0}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
