<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class CommerceTest extends TestCase
{
    public function testFromArray()
    {
        $commerce = Models\Commerce::fromArray([
            'CommerceId' => 123,
            'Name' => 'Commerce Name',
        ]);
        $signedRequest = new SignedRequest($commerce);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($commerce->validate());
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"CommerceId":123,"Name":"Commerce Name"}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testEmptyCommerceId()
    {
        $commerce = Models\Commerce::fromArray([
            'Name' => 'Commerce Name',
        ]);
        $signedRequest = new SignedRequest($commerce);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($commerce->validate());
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Name":"Commerce Name"}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testEmptyName()
    {
        $commerce = Models\Commerce::fromArray([
            'Name' => 'Commerce Name',
        ]);
        $signedRequest = new SignedRequest($commerce);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($commerce->validate());
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Name":"Commerce Name"}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testCommerceIdCoercion()
    {
        $commerce = Models\Commerce::fromArray([
            'Name' => 'Commerce Name',
        ]);
        $signedRequest = new SignedRequest($commerce);
        $signedRequest->setClient('Prueba');
        
        $commerce->CommerceId = '456';
        $this->assertEmpty($commerce->validate());
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"CommerceId":456,"Name":"Commerce Name"}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
