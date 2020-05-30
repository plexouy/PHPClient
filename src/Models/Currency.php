<?php
namespace Plexo\Sdk\Models;

class Currency extends ModelsBase
{
    /**
     * @var int $CurrencyId;
     * @var string $Name;
     * @var string $Plural;
     * @var string $Symbol;
     */

    protected $data = [
        'CurrencyId' => null,
        'Name' => null,
        'Plural' => null,
        'Symbol' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'CurrencyId' => [
                'type' => 'int',
                'required' => false,
            ],
            'Name' => [
                'type' => 'string',
                'required' => false,
            ],
            'Plural' => [
                'type' => 'string',
                'required' => false,
            ],
            'Symbol' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }
}
