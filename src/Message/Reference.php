<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;
use Plexo\Sdk\Type\ReferenceType;

class Reference extends Sdk\Message {

    /**
     *
     * @var string $MetaReference;
     * @var ReferenceType $Type;
     */
    protected $data = [
        'MetaReference' => null,
        'Type' => null,
    ];

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
}
