<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class PaymentRequestTest extends TestCase
{
    public function setUp()
    {
        $this->paymentRequestData = [
            'ClientReferenceId' => '12345',
            'CurrencyId' => Type\CurrencyType::UYU,
            'FinancialInclusion' => [
                'Type' => Type\InclusionType::NONE,
                'BilledAmount' => 123,
                'InvoiceNumber' => 123456,
                'TaxedAmount' => 123.123,
            ],
            'Installments' => 3,
            'Items' => [
                [
                    'Amount' => 321.123,
                    'ClientItemReferenceId' => '12345',
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
                ],
                [
                    'Amount' => 321.012,
                    'ClientItemReferenceId' => '23456',
                ],
                [
                    'Amount' => 321.1,
                    'ClientItemReferenceId' => '34567',
                ],
            ],
            'PaymentInstrumentInput' => [
                'InstrumentToken' => '0123456789ABCDEF0123456789ABCDEF',
                'UseExtendedClientCreditIfAvailable' => true,
                'OptionalCommerceId' => 42,
                'NonStorableItems' => [
                    'Name' => 'Nombre',
                    Type\FieldType::EMAIL => 'mail@example.net',
                    new Type\FieldType(Type\FieldType::FIRST_NAME, 'Pepe'),
                ],
                'OptionalInstrumentFields' => [
                    'Name' => 'Nombre',
                    Type\FieldType::EMAIL => 'mail@example.net',
                    new Type\FieldType(Type\FieldType::FIRST_NAME, 'Pepe'),
                ],
            ],
        ];
    }

    public function testCanBeCreatedFromValidArray()
    {
        $paymentRequest = Models\PaymentRequest::fromArray($this->paymentRequestData);
        $this->assertInstanceOf(
            Models\PaymentRequest::class,
            $paymentRequest
        );
        $this->assertEmpty($paymentRequest->validate());
        return $paymentRequest;
    }

    /**
     * @depends testCanBeCreatedFromValidArray
     */
    public function testSignatureBaseString($paymentRequest)
    {
        $signedRequest = new SignedRequest($paymentRequest);
        $signedRequest->setClient('Prueba');
        $this->assertSame(
            '{'.
              '"Fingerprint":"",'.
              '"Object":{'.
                '"Client":"Prueba",'.
                '"Request":{'.
                  '"ClientReferenceId":"12345",'.
                  '"CurrencyId":1,'.
                  '"FinancialInclusion":{'.
                    '"BilledAmount":123.0,'.
                    '"InvoiceNumber":123456,'.
                    '"TaxedAmount":123.123,'.
                    '"Type":0'.
                  '},'.
                  '"Installments":3,'.
                  '"Items":['.
                    '{"Amount":321.123,"ClientItemReferenceId":"12345","InfoLines":[{"Amount":123.0,"Text":"Abc"},{"Amount":321.0,"Text":"Xyz"},{"Amount":987.0,"Text":"Qwerty"}],"MetaData":"Metadata info","Tags":["a","b","c"]},'.
                    '{"Amount":321.012,"ClientItemReferenceId":"23456"},'.
                    '{"Amount":321.1,"ClientItemReferenceId":"34567"}'.
                  '],'.
                  '"PaymentInstrumentInput":{'.
                    '"InstrumentToken":"0123456789ABCDEF0123456789ABCDEF",'.
                    '"NonStorableItems":{"Email":"mail@example.net","FirstName":"Pepe","Name":"Nombre"},'.
                    '"OptionalInstrumentFields":{"Email":"mail@example.net","FirstName":"Pepe","Name":"Nombre"},'.
                    '"UseExtendedClientCreditIfAvailable":true'.
                  '}'.
                '}'.
              '},'.
              '"UTCUnixTimeExpiration":null'.
            '}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testEmptyModel()
    {
        $this->assertEquals(
            new Models\PaymentRequest(),
            Models\PaymentRequest::fromArray([])
        );
    }

    public function testDefaults()
    {
        $paymentRequest = new Models\PaymentRequest();
        $this->assertSame(0, $paymentRequest['Installments']);
        $this->assertSame(Type\CurrencyType::UYU, $paymentRequest['CurrencyId']);
        return $paymentRequest;
    }

    public function testImplementsArrayAccess()
    {
        $paymentRequest = new Models\PaymentRequest();
        $paymentRequest['CurrencyId'] = Type\CurrencyType::USD;
        $this->assertSame(Type\CurrencyType::USD, $paymentRequest['CurrencyId']);
    }

    public function testSetGet()
    {
        $paymentRequest = new Models\PaymentRequest();
        $paymentRequest->CurrencyId = Type\CurrencyType::USD;
        $this->assertSame(Type\CurrencyType::USD, $paymentRequest['CurrencyId']);
        $this->assertSame(Type\CurrencyType::USD, $paymentRequest->CurrencyId);
    }

    public function testRequireInstallments()
    {
        $paymentRequest = Models\PaymentRequest::fromArray([
            'Installments' => null,
            'Items' => [
                [
                    'Amount' => 100.0,
                    'ClientItemReferenceId' => '12345',
                ],
            ],
            'PaymentInstrumentInput' => [
                'InstrumentToken' => '919B3143797E4032BD8134E85B2DE1F5',
            ],
        ]);
        $this->assertArraySubset([[
            'class' => 'Plexo\Sdk\Models\PaymentRequest',
            'error' => 'Installments cannot be empty',
        ]], $paymentRequest->validate());
    }

    public function testRequireItems()
    {
        $paymentRequest = Models\PaymentRequest::fromArray([
            'PaymentInstrumentInput' => [
                'InstrumentToken' => '919B3143797E4032BD8134E85B2DE1F5',
                'UseExtendedClientCreditIfAvailable' => true,
                'OptionalCommerceId' => 48,
            ],
        ]);
        $this->assertArraySubset([[
                'class' => 'Plexo\\Sdk\\Models\\PaymentRequest',
                'error' => 'Items cannot be empty',
            ]],
            $paymentRequest->validate()
        );
    }

    public function testRequirePaymentInstrumentInput()
    {
        $paymentRequest = Models\PaymentRequest::fromArray([
            'Items' => [
                [
                    'Amount' => 100.0,
                    'ClientItemReferenceId' => '12345',
                ],
            ],
        ]);
        $paymentRequest->toArray(true);
    }

    public function testValidateRecursive()
    {
        array_push($this->paymentRequestData['Items'], [
            'ClientItemReferenceId' => '34567',
        ]);
        $paymentRequest = Models\PaymentRequest::fromArray($this->paymentRequestData);
        $errors = $paymentRequest->validate();
        $this->assertArraySubset([[
            'class' => 'Plexo\\Sdk\\Models\\Item',
            'error' => 'Amount cannot be empty',
        ]], $errors);
    }
}
