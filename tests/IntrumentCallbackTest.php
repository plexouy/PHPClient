<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;

final class IntrumentCallbackTest extends TestCase
{
    public function testCanBeCreatedFromJson()
    {
        $signedRequest = SignedRequest::fromJson('{"Object":{"Object":{"SessionId":"0123456789abcdef0123456789abcdef","Client":"Cliente","Action":1,"PaymentInstrument":{"InstrumentToken":"00112233445566778899aabbccddeeff","Name":"532399XXXXXX4516","Issuer":{"Id":"4","IssuerId":4,"VariationId":0,"Issuer":"MasterCard","ImageUrl":"http://xx.xx.xx.xx/images/instruments/4.png","MayHaveAsyncPayments":false,"SupportsReserve":false,"MayHavePaymentsLimits":false,"Fields":[{"LabelName":"Numero de Comercio","FieldType":2049,"Required":true}]},"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}],"Status":0,"InstrumentExpirationUTC":1582934400,"CreditLimits":[],"AdditionalRequirements":[],"InstrumentInformation":{}},"OptionalMetadata":"bla bla bla"},"Fingerprint":"ABCDEF0123456789ABCDEF0123456789ABCDEF01","UTCUnixTimeExpiration":1526558503},"Signature":"aGVHr9jHQ+DgimvtRc4AYO5fd3mFhJrVvcEVVE3Im7I1W1MUKEnnCIstqRyJ7W08XQuqn2gJc/P0yO3/OOM3COAgYsjFmaondhJvnotIbrOZK8f1FCodsZc7Wlk+pkY1xG91WUGiv3aqboOVhM/+nXjgokR9E4egNPtNCbidrrtjcdsYMjtBUnumDz67NMWJ71v2ulCBW2UuYzBCRmxNBf/pB0kpP0XzlyQhH1dMm7+Eds0dv2/yb9Nbc8UEJuCSjz9ysdKOayJkIyu4/c5+WWb4PqpyAO7WL4z+n/KMUUrwCV2gCKqbtjALoCbuX+3NODIGvlQJ5ymmlS5p4Q49UBgb0SjqAyH6ePuUNyie+EZWyGtaKhMbu0xYmhmZUDbEmzBQWlqj3d0Ul4smqBiUPnH+UzvTPREZeUaGu5TNkwWWbFCbcr13X6N5zPbyk48bpHATdpywh7NqvEdro+8d9TUumINJ8pQaewMSyE/aDW3fecuGzdSiJoZ7AGWGdfPejOikJe6YCvl2z532jTXEsZDweFSTY787OACWrB+qF1R5fIOfB20XC1md+XmuUo2f2udVUGi5qZfZZf5f+2ADPB8UqEG1ChCjrFGUvRje3+WXZG/WDovlrwq2oyLsBNfdkSAtDaBdO7KXNFzNNRwCJTT0uxguI8WT0w5EXcSba/4="}');
        $this->assertInstanceOf(
            SignedMessage::class,
            $signedRequest
        );
        return $signedRequest;
    }

    /**
     * @depends testCanBeCreatedFromJson
     */
    public function testSignatureBaseString($signedRequest)
    {
        $this->assertEquals(
            '{"Fingerprint":"ABCDEF0123456789ABCDEF0123456789ABCDEF01","Object":{"Action":1,"Client":"Cliente","OptionalMetadata":"bla bla bla","PaymentInstrument":{"AdditionalRequirements":[],"CreditLimits":[],"InstrumentExpirationUTC":1582934400,"InstrumentInformation":{},"InstrumentToken":"00112233445566778899aabbccddeeff","Issuer":{"Fields":[{"FieldType":2049,"LabelName":"Numero de Comercio","Required":true}],"Id":"4","ImageUrl":"http://xx.xx.xx.xx/images/instruments/4.png","Issuer":"MasterCard","IssuerId":4,"MayHaveAsyncPayments":false,"MayHavePaymentsLimits":false,"SupportsReserve":false,"VariationId":0},"Name":"532399XXXXXX4516","Status":0,"SupportedCurrencies":[{"CurrencyId":1,"Name":"Peso","Plural":"Pesos","Symbol":"$"},{"CurrencyId":2,"Name":"Dólar","Plural":"Dólares","Symbol":"U$S"}]},"SessionId":"0123456789abcdef0123456789abcdef"},"UTCUnixTimeExpiration":1526558503}',
            $signedRequest->getSignatureBaseString()
        );
    }
}
