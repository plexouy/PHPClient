<?php
namespace Plexo\Sdk\Models;

class CancelRequest extends ModelsBase
{
    /**
     * @var int $Type
     * @var string $ClientReferenceId
     * @var string $MetaReference
     * @var int $OptionalClientId
     */
    
    protected $data = [
        'ClientReferenceId' => null,
        'MetaReference' => null,
        'OptionalClientId' => null,
        'Type' => 0,
    ];

    public static function getValidationMetadata()
    {
        return [
            'ClientReferenceId' => [
                'type' => 'string',
                'required' => false,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
            'OptionalClientId' => [
                'type' => 'int',
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
