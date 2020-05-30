<?php
namespace Plexo\Sdk\Models;

class IssuerInfo extends ModelsBase
{
    /**
     * @var string $Id;
     * @var int $IssuerId;
     * @var int $VariationId;
     * @var string $Issuer;
     * @var string $Bank;
     * @var string $Variation;
     * @var string $ImageUrl;
     * @var bool $MayHaveAsyncPayments;
     * @var bool $SupportsReserve;
     * @var bool $MayHavePaymentsLimits;
     * @var array List<FieldInfo> $Fields;
     */

    protected $data = [
        'Id' => null,
        'IssuerId' => null,
        'VariationId' => null,
        'Issuer' => null,
        'Bank' => null,
        'Variation' => null,
        'ImageUrl' => null,
        'MayHaveAsyncPayments' => null,
        'SupportsReserve' => null,
        'MayHavePaymentsLimits' => null,
        'Fields' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'Id' => [
                'type' => 'string',
                'required' => false,
            ],
            'IssuerId' => [
                'type' => 'int',
                'required' => false,
            ],
            'VariationId' => [
                'type' => 'int',
                'required' => false,
            ],
            'Issuer' => [
                'type' => 'string',
                'array' => true,
                'required' => false,
            ],
            'Bank' => [
                'type' => 'string',
                'required' => false,
            ],
            'Variation' => [
                'type' => 'string',
                'required' => false,
            ],
            'ImageUrl' => [
                'type' => 'string',
                'required' => false,
            ],
            'MayHaveAsyncPayments' => [
                'type' => 'bool',
                'required' => false,
            ],
            'SupportsReserve' => [
                'type' => 'bool',
                'required' => false,
            ],
            'MayHavePaymentsLimits' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Fields' => [
                'type' => 'array',
                'required' => false,
            ],
        ];
    }
}
