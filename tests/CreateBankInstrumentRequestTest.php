<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class CreateBankInstrumentRequestTest extends TestCase
{
    public function testFromArray()
    {
        $createBankInstrumentRequest = Models\CreateBankInstrumentRequest::fromArray([
            'IssuerId' => '13',
            'User' => [
                'Type' => Type\AuthorizationType::ANONYMOUS,
                'MetaReference' => 'meta reference'
            ],
            'InstrumentData' => [
                'FirstName' => 'Pepe',
                new Type\FieldType(Type\FieldType::LAST_NAME, 'Botella'),
                Type\FieldType::CITY => 'Génova',
            ]
        ]);
        $this->assertEmpty($createBankInstrumentRequest->validate());
        return $createBankInstrumentRequest;
    }

    /**
     * @depends testFromArray
     */
    public function testSignatureBaseString($createBankInstrumentRequest)
    {
        $signedRequest = new SignedRequest($createBankInstrumentRequest);
        $signedRequest->setClient('Prueba');
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"InstrumentData":{"City":"Génova","FirstName":"Pepe","LastName":"Botella"},"IssuerId":13,"User":{"MetaReference":"meta reference","Type":2}}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
