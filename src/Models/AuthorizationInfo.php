<?php
namespace Plexo\Sdk\Models;

class AuthorizationInfo extends ModelsBase
{
    /**
     * @var int $Type Any of the Plexo\Type\AuthorizationType constants
     * @var string $MetaReference 
     */
    protected $data = [
        'MetaReference' => null,
        'Type' => 0,
    ];

    public static function getValidationMetadata()
    {
        return [
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
