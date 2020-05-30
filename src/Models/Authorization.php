<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Type;

class Authorization extends ModelsBase
{
    /**
     * @var int $Action              Action type defined in Plexo\Sdk\Type\ActionType
     * @var int $Type                Authorization type defined in Sdk\Type\AuthorizationType 
     * @var string $MetaReference 
     * @var string $RedirectUri
     * @var string $OptionalMetadata (Optional) 
     * @var array <string, object> $ClientInformation (Optional) Sdk\Type\FieldType's list
     * @var array <string> $LimitIssuers  (Optional) 
     * @var Dictionary<string, string> $PromotionInfoIssuers (Optional)  
     * @var string $ExtendableInstrumentToken (Optional) 
     * @var bool $DoNotUseCallback Default false
     */

    protected $data = [
        'Action' => null,
        'ClientInformation' => null,
        'DoNotUseCallback' => false,
        'ExtendableInstrumentToken' => null,
        'LimitIssuers' => null,
        'MetaReference' => null,
        'OptionalMetadata' => null,
        'PromotionInfoIssuers' => null,
        'RedirectUri' => null,
        'Type' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'Action' => [
                'type' => 'int',
                'required' => true,
            ],
            'Type' => [
                'type' => 'int',
                'required' => true,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
           'RedirectUri' => [
                'type' => 'string',
                'required' => true,
           ],
            'OptionalMetadata' => [
                'type' => 'string',
                'required' => false,
            ],
            'ClientInformation' => [
                'type' => 'array',
                'required' => false,
            ],
            'DoNotUseCallback' => [
                'type' => 'bool',
                'required' => false,
            ],
            'LimitIssuers' => [
                'type' => 'array',
                'required' => false,
            ],
            'PromotionInfoIssuers' => [
                'type' => 'array',
                'required' => false,
            ],
            'ExtendableInstrumentToken' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

    public function addClientInformationField($value, $k = null)
    {
        array_push($this->data['ClientInformation'], ($value instanceof Type\FieldType ? $value : new Type\FieldType($k, $value)));
        return $this;
    }

    public function setClientInformation(array $value)
    {
        $this->data['ClientInformation'] = [];
        foreach ($value as $k => $item) {
            $this->addClientInformationField($item, $k);
        }
        return $this;
    }

    public function clientInformationToArray()
    {
        if (!is_array($this->data['ClientInformation']) || count($this->data['ClientInformation']) === 0) {
            return null;
        }
        $hash = [];
        foreach ($this->data['ClientInformation'] as $item) {
            $hash[$item->getParamName()] = $item->getValue();
        }
        ksort($hash);
        return $hash;
    }

    public function promotionInfoIssuersToArray()
    {
        if (!is_array($this->data['PromotionInfoIssuers']) || count($this->data['PromotionInfoIssuers']) === 0) {
            return null;
        }
        $hash = [];
        foreach ($this->data['PromotionInfoIssuers'] as $k => $v) {
            $hash[(string) $k] = (string) $v;
        }
        ksort($hash);
        return $hash;
    }

    public function toArray($canonize = false)
    {
        $arr = $this->data;
        $arr['ClientInformation'] = $this->clientInformationToArray();
        $arr['PromotionInfoIssuers'] = $this->promotionInfoIssuersToArray();
        return $arr;
    }
}
