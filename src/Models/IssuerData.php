<?php
namespace Plexo\Sdk\Models;

class IssuerData extends ModelsBase
{
    /**
     * @var int $IssuerId
     * @var int $CommerceId
     * @var array $Metadata Dictionary<FieldType,string> 
     */
    protected $data = [
        'IssuerId' => null,
        'CommerceId' => null,
        'Metadata' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'IssuerId' => [
                'type' => 'int',
                'required' => false,
            ],
            'CommerceId' => [
                'type' => 'int',
                'required' => false,
            ],
            'Metadata' => [
                'type' => 'array',
                'required' => false,
            ],
        ];
    }

    public function setIssuerId($value)
    {
        if (is_scalar($value) && is_numeric($value)) {
            $this->data['IssuerId'] = (int) $value;
        }
        return $this;
    }

    public function toArray($canonize = false) {
        $arr = [
            'IssuerId' => $this->data['IssuerId'],
            'CommerceId' => $this->data['CommerceId'],
        ];
        if ($this->data['Metadata'] && is_array($this->data['Metadata'])) {
            $arr['Metadata'] = [];
            foreach ($this->data['Metadata'] as $k => $v) {
                $arr['Metadata'][$k] = (string) $v; 
            }
        }
        return $arr;
    }
}
