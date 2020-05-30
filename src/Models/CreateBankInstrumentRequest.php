<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Type;

class CreateBankInstrumentRequest extends ModelsBase
{
    /**
     * @var int $IssuerId
     * @var Plexo\Sdk\Models\AuthorizationInfo $User
     * @var array Dictionary<FieldType, string> $InstrumentData
     */
    protected $data = [
        'IssuerId' => null,
        'User' => null,
        'InstrumentData' => [],
    ];

    public static function getValidationMetadata()
    {
        return [
            'IssuerId' => [
                'type' => 'int',
                'required' => false,
            ],
            'User' => [
                'type' => 'class',
                'class' => 'AuthorizationInfo',
                'required' => false,
            ],
            'InstrumentData' => [
                'type' => 'array',
                'required' => false,
            ],
        ];
    }

    public function setUser($value) {
        $this->data['User'] = $value instanceof AuthorizationInfo ? $value : AuthorizationInfo::fromArray($value);
    }

    public function addInstrumentData($value, $k = null)
    {
        array_push($this->data['InstrumentData'], ($value instanceof Type\FieldType ? $value : new Type\FieldType($k, $value)));
        return $this;
    }

    public function setInstrumentData(array $value)
    {
        $this->data['InstrumentData'] = [];
        foreach ($value as $k => $item) {
            $this->addInstrumentData($item, $k);
        }
        return $this;
    }

    public function instrumentDataToArray()
    {
        if (!is_array($this->data['InstrumentData']) || count($this->data['InstrumentData']) === 0) {
            return null;
        }
        $hash = [];
        foreach ($this->data['InstrumentData'] as $item) {
            $hash[$item->getParamName()] = $item->getValue();
        }
        ksort($hash);
        return $hash;
    }

    public function toArray($canonize = false)
    {
        return [
            'InstrumentData' => $this->instrumentDataToArray(),
            'IssuerId' => $this->data['IssuerId'],
            'User' => $this->data['User']->toArray(),
        ];
    }
}
