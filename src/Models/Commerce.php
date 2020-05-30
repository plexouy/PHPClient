<?php
namespace Plexo\Sdk\Models;

class Commerce extends ModelsBase
{
    /**
     * @var int $CommerceId
     * @var string $Name
     */
    protected $data = [
        'CommerceId' => null,
        'Name' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'CommerceId' => [
                'type' => 'int',
                'required' => false,
            ],
            'Name' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }
}
