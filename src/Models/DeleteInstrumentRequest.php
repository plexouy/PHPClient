<?php
namespace Plexo\Sdk\Models;

class DeleteInstrumentRequest extends ModelsBase
{
    /**
     * @var string $InstrumentToken
     * @var string $MetaReference
     * @var int $Type One of the AuthorizationType constants
     */
    protected $data = [
        'InstrumentToken' => null,
        'MetaReference' => null,
        'Type' => 0,
    ];

    public static function getValidationMetadata()
    {
        return [
            'InstrumentToken' => [
                'type' => 'string',
                'required' => false,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
            'Type' => [
                'type' => 'int',
                'required' => true,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        return $this->data;
    }
}
