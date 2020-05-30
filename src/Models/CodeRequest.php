<?php
namespace Plexo\Sdk\Models;

class CodeRequest extends ModelsBase
{
    const CODE_ACTION_QUERY           = 0;
    const CODE_ACTION_PAY             = 1;
    const CODE_ACTION_DENY            = 2;
    const CODE_ACTION_END_CANCELATION = 3;

    /**
     *
     * @var string Code
     * @var int Action
     */
    protected $data = [
        'Code' => null,
        'Action' => self::CODE_ACTION_QUERY,
    ];

    public function __construct($code = null, $action = 0) {
        $this->data['Code'] = $code;
        $this->data['Action'] = $action;
    }

    public static function getValidationMetadata()
    {
        return [
            'Code' => [
                'type' => 'string',
                'required' => false,
            ],
            'Action' => [
                'type' => 'int',
                'required' => false,
            ],
        ];
    }

    public function toArray($canonize = false) {
        return $this->data;
    }
}
