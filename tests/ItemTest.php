<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class ItemTest extends TestCase
{
    public function testCanBeCreatedFromValidArray()
    {
        $item = Models\Item::fromArray([
            'Amount' => 123,
            'ClientItemReferenceId' => '123456',
            'InfoLines' => [
                [
                    'Text' => 'Abc',
                    'Amount' => 123,
                ],
                new Models\InfoLine('Xyz', 321),
                Models\InfoLine::fromArray([
                    'Text' => 'Qwerty',
                    'Amount' => '987',
                ]),
            ],
            'Tags' => ['a', 'b', 'c'],
            'MetaData' => 'Metadata info',
        ]);
        $this->assertEmpty($item->validate());
        return $item;
    }

    /**
     * @depends testCanBeCreatedFromValidArray
     */
    public function testSignature($item)
    {
        $signedRequest = new SignedRequest($item);
        $signedRequest->setClient('Prueba');
        $this->assertSame(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{'.
              '"Amount":123.0,"ClientItemReferenceId":"123456",'.
              '"InfoLines":['.
                '{"Amount":123.0,"Text":"Abc"},{"Amount":321.0,"Text":"Xyz"},{"Amount":987.0,"Text":"Qwerty"}'.
              '],"MetaData":"Metadata info","Tags":["a","b","c"]'.
            '}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
        return $item;
    }

    public function testRequired()
    {
        $item = new Models\Item();
        $errors = $item->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
            'class' => 'Plexo\Sdk\Models\Item',
            'error' => 'Amount cannot be empty',
        ]], $errors);
        return $item;
    }

    public function testDefaultsSignature()
    {
        $item = Models\Item::fromArray([
            'Amount' => 123,
        ]);
        $signedRequest = new SignedRequest($item);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($item->validate());
        $this->assertSame(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Amount":123.0}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testStringAmountCoercion()
    {
        $item = Models\Item::fromArray([
            'Amount' => '123',
        ]);
        $signedRequest = new SignedRequest($item);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($item->validate());
        $this->assertSame(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Amount":123.0}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );

        $item->Amount = '234.5';
        $this->assertEmpty($item->validate());
        $this->assertSame(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Amount":234.5}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );

        $item['Amount'] = '345.05';
        $this->assertEmpty($item->validate());
        $this->assertSame(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Amount":345.05}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testIntAmountCoercion()
    {
        $item = Models\Item::fromArray([
            'Amount' => 123,
        ]);
        $signedRequest = new SignedRequest($item);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($item->validate());
        $this->assertSame(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Amount":123.0}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testSetGet()
    {
        $item = Models\Item::fromArray([
            'ClientItemReferenceId' => 'a',
        ]);
        $this->assertSame('a', $item->ClientItemReferenceId);
        $this->assertSame('a', $item['ClientItemReferenceId']);

        $item->ClientItemReferenceId = 'b';
        $this->assertSame('b', $item->ClientItemReferenceId);
        $this->assertSame('b', $item['ClientItemReferenceId']);

        $item['ClientItemReferenceId'] = 'c';
        $this->assertSame('c', $item->ClientItemReferenceId);
        $this->assertSame('c', $item['ClientItemReferenceId']);
    }
}
