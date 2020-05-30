<?php
namespace Plexo\Sdk\Models;

class AmountLimit extends ModelsBase
{
    /**
     * @var float $Amount
     * @var float $ExtendedAmount
     * @var Currency $Currency
     * @var bool $SupportsExtendedLimit
     */
    
    protected $data = [
        'Amount' => null,
        'ExtendedAmount' => null,
        'Currency' => null,
        'SupportsExtendedLimit' => 0,
    ];

    public static function getValidationMetadata()
    {
        return [
            'Amount' => [
                'type' => 'float',
                'required' => false,
            ],
            'ExtendedAmount' => [
                'type' => 'float',
                'required' => false,
            ],
            'Currency' => [
                'type' => 'class',
                'class' => 'Currency',
                'required' => false,
            ],
            'SupportsExtendedLimit' => [
                'type' => 'bool',
                'required' => false,
            ],
        ];
    }
}
