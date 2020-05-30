<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class ReserveTest extends TestCase
{
    public function testFromArray()
    {
        $reserve = Models\Reserve::fromArray([
            'Commit' => true,
            'MetaReference' => 'asd',
            'Type' => Type\ReferenceType::CLIENT_CANCEL_REFERENCE_ID,
        ]);
        $this->assertEmpty($reserve->validate());
        return $reserve;
    }

    /**
     * @depends testFromArray
     */
    public function testSignatureBaseString($reserve)
    {
        $signedRequest = new SignedRequest($reserve);
        $signedRequest->setClient('Prueba');
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Commit":true,"MetaReference":"asd","Type":2}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
