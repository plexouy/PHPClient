<?php
namespace Plexo\Sdk\Models;

class BlacklistRequest extends ModelsBase
{
    /**
     * @var string $InstrumentToken
     * @var string $OptionalUserName
     * @var string $Reason
     */
    protected $data = [
        'InstrumentToken' => null,
        'OptionalUserName' => null,
        'Reason' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'InstrumentToken' => [
                'type' => 'string',
                'required' => true,
            ],
            'OptionalUserName' => [
                'type' => 'string',
                'required' => false,
            ],
            'Reason' => [
                'type' => 'string',
                'required' => true,
            ],
        ];
    }
}
