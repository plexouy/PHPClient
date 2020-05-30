<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class IssuerDataTest extends TestCase
{
    public function setUp()
    {
        $this->dataArray = [
            'IssuerId' => 4,
            'CommerceId' => 39,
            'Metadata' => [
                'ProviderCommerceNumber' => '20000012',
                'TerminalNumber' => 123456,
            ]
        ];
    }

//    public function testRequireIssuerId()
//    {
//        $issuerData = Models\IssuerData::fromArray([
//            'CommerceId' => 39,
//            'Metadata' => [
//                'ProviderCommerceNumber' => '20000012',
//            ]
//        ]);
//        $errors = $issuerData->validate();
//        $this->assertNotEmpty($errors);
//        $this->assertArraySubset([[
//                'class' => 'Plexo\\Sdk\\Models\\IssuerData',
//                'error' => 'IssuerId cannot be empty',
//            ]],
//            $errors
//        );
//    }

//    public function testRequireCommerceId()
//    {
//        $issuerData = Models\IssuerData::fromArray([
//            'IssuerId' => 4,
//            'Metadata' => [
//                'ProviderCommerceNumber' => '20000012',
//            ]
//        ]);
//        $errors = $issuerData->validate();
//        $this->assertNotEmpty($errors);
//        $this->assertArraySubset([[
//                'class' => 'Plexo\\Sdk\\Models\\IssuerData',
//                'error' => 'CommerceId cannot be empty',
//            ]],
//            $errors
//        );
//    }

//    public function testRequireMetadata()
//    {
//        $issuerData = Models\IssuerData::fromArray([
//            'CommerceId' => 39,
//            'IssuerId' => 4,
//        ]);
//        $errors = $issuerData->validate();
//        $this->assertNotEmpty($errors);
//        $this->assertArraySubset([[
//                'class' => 'Plexo\Sdk\Models\IssuerData',
//                'error' => 'Metadata cannot be empty',
//            ]],
//            $errors
//        );
//    }

//    public function testRequireMetadataItems()
//    {
//        $issuerData = Models\IssuerData::fromArray([
//            'CommerceId' => 39,
//            'IssuerId' => 4,
//            'Metadata' => [],
//        ]);
//        $errors = $issuerData->validate();
//        $this->assertNotEmpty($errors);
//        $this->assertArraySubset([[
//                'class' => 'Plexo\Sdk\Models\IssuerData',
//                'error' => 'Metadata cannot be empty',
//            ]],
//            $errors
//        );
//    }

    public function testGetSet()
    {
        $issuerData = new Models\IssuerData();

        $issuerData->IssuerId = 1;
        $this->assertSame(1, $issuerData->IssuerId);
        $this->assertSame(1, $issuerData['IssuerId']);
        
        $issuerData->IssuerId = 2;
        $this->assertSame(2, $issuerData->IssuerId);
        $this->assertSame(2, $issuerData['IssuerId']);
    }

    public function testIssuerIdCoercion()
    {
        $issuerData = Models\IssuerData::fromArray($this->dataArray);
        $signedRequest = new SignedRequest($issuerData);
        $signedRequest->setClient('Prueba');

        $issuerData->IssuerId = '1';
        $issuerData->validate();
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"CommerceId":39,"IssuerId":1,"Metadata":{"ProviderCommerceNumber":"20000012","TerminalNumber":"123456"}}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testCommerceIdCoercion()
    {
        $issuerData = Models\IssuerData::fromArray($this->dataArray);
        $signedRequest = new SignedRequest($issuerData);
        $signedRequest->setClient('Prueba');

        $issuerData->CommerceId = '1';
        $issuerData->validate();
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"CommerceId":1,"IssuerId":4,"Metadata":{"ProviderCommerceNumber":"20000012","TerminalNumber":"123456"}}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
