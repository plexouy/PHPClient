<?php
namespace Plexo\Sdk\Models;

class Reference extends ModelsBase
{
    /**
     * @var int $Type Plexo\Sdk\Type\ReferenceType::*
     * @var string $MetaReference
     */
    
    protected $data = [
        'MetaReference' => null,
        'Type' => 0,
    ];

    public static function getValidationMetadata()
    {
        return [
            'Type' => [
                'type' => 'int',
                'required' => false,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        $arr = $canonize
        ? [
            'MetaReference' => $this->MetaReference,
            'Type' => $this->Type,
        ]
        : [
            'MetaReference' => $this->MetaReference,
            'Type' => $this->Type,
        ];
        return $arr;
    }
}
