<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;
use Plexo\Sdk\Type;

final class AuthorizationTest extends TestCase
{
    public function setUp()
    {
        $this->data = [
            'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
            'Type' => Type\AuthorizationType::ANONYMOUS,
            'MetaReference' => 123,
            'RedirectUri' => 'https://example.net/ret',
            'OptionalMetadata' => 456,
            'DoNotUseCallback' => false,
            'ClientInformation' => [
                Type\FieldType::CELLPHONE => '555-123456',
                new Type\FieldType(Type\FieldType::IDENTIFICATION_TYPE, Type\FieldType::IDENTIFICATION_TYPE_CI),
                new Type\FieldType(Type\FieldType::IDENTIFICATION, '11111111'),
                Type\FieldType::FIRST_NAME => 'Lía',
            ],
            'LimitIssuers' => ['a', 'b', 'c'],
            'MetaReference' => null,
            'PromotionInfoIssuers' => [
                'X' => 1,
                'Y' => 2,
            ],
            'ExtendableInstrumentToken' => 'Token',
        ];
    }

    public function testSignatureBaseString()
    {
        $authorization = Models\Authorization::fromArray($this->data);
        $signedRequest = new SignedRequest($authorization);
        $signedRequest->setClient('Prueba');
        $this->assertEmpty($authorization->validate());
        $this->assertEquals(
            '{"Fingerprint":"","Object":{"Client":"Prueba","Request":{"Action":3,"ClientInformation":{"Cellphone":"555-123456","FirstName":"Lía","Identification":"11111111","IdentificationType":"0"},"DoNotUseCallback":false,"ExtendableInstrumentToken":"Token","LimitIssuers":["a","b","c"],"OptionalMetadata":"456","PromotionInfoIssuers":{"X":"1","Y":"2"},"RedirectUri":"https://example.net/ret","Type":2}},"UTCUnixTimeExpiration":null}',
            $signedRequest->getSignatureBaseString()
        );
    }

    public function testRequireAction()
    {
        $authorization = Models\Authorization::fromArray([
            'Type' => Type\AuthorizationType::ANONYMOUS,
            'RedirectUri' => 'https://example.net/ret',
        ]);
        $errors = $authorization->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
                'class' => 'Plexo\Sdk\Models\Authorization',
                'error' => 'Action cannot be empty',
            ]],
            $errors
        );
    }

    public function testRequireType()
    {
        $authorization = Models\Authorization::fromArray([
            'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
            'RedirectUri' => 'https://example.net/ret',
        ]);
        $errors = $authorization->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
                'class' => 'Plexo\Sdk\Models\Authorization',
                'error' => 'Type cannot be empty',
            ]],
            $errors
        );
    }

    public function testRequireRedirectUri()
    {
        $authorization = Models\Authorization::fromArray([
            'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
            'Type' => Type\AuthorizationType::ANONYMOUS,
        ]);
        $errors = $authorization->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
                'class' => 'Plexo\Sdk\Models\Authorization',
                'error' => 'RedirectUri cannot be empty',
            ]],
            $errors
        );
    }
}
