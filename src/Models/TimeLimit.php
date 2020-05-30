<?php
namespace Plexo\Sdk\Models;

class TimeLimit extends ModelsBase
{
    /**
     * @var int $SecondsLeft
     * @var \Plexo\Sdk\Type\FieldType $RequirementAfterTimeLimit
     */

    protected $data = [
        'SecondsLeft' => 0,
        'RequirementAfterTimeLimit' => null,
    ];

    public function __construct($secondsLeft, $requirementAfterTimeLimit)
    {
        $this->data['SecondsLeft'] = $secondsLeft;
        $this->data['RequirementAfterTimeLimit'] = $requirementAfterTimeLimit;
    }

    public static function getValidationMetadata()
    {
        return [
            'SecondsLeft' => [
                'type' => 'int',
                'required' => false,
            ],
            'RequirementAfterTimeLimit' => [
                'type' => 'int',
                'required' => false,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        return [
            'RequirementAfterTimeLimit' => $this->data['RequirementAfterTimeLimit'],
            'SecondsLeft' => $this->data['SecondsLeft'],
        ];
    }
}
