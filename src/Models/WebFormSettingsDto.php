<?php
namespace Plexo\Sdk\Models;

class WebFormSettingsDto extends ModelsBase
{
    /**
     * @var ExpressCheckoutSettingsDto $ExpressCheckout
     * @var TokenizationSettingsDto $Tokenization
     * @var UIOptionsDto $UI
     */
    
    protected $data = [
        'ExpressCheckout' => null,
        'Tokenization' => null,
        'UI' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'ExpressCheckout' => [
                'type' => 'class',
                'class' => 'ExpressCheckoutSettingsDto',
                'required' => false,
            ],
            'Tokenization' => [
                'type' => 'class',
                'class' => 'TokenizationSettingsDto',
                'required' => false,
            ],
            'UI' => [
                'type' => 'class',
                'class' => 'UIOptionsDto',
                'required' => false,
            ],
            
        ];
    }
    
    public function setUI($value)
    {
        $this->data['UI'] = UIOptionsDto::fromArray($value);
        return $this;
    }
    
    public function setExpressCheckout($value)
    {
        $this->data['ExpressCheckout'] = ExpressCheckoutSettingsDto::fromArray($value);
        return $this;
    }
    
    public function setTokenization($value)
    {
        $this->data['Tokenization'] = TokenizationSettingsDto::fromArray($value);
        return $this;
    }
    
    public function toArray($canonize = false)
    {
        $arr = $this->data;
        if (!is_null($arr['UI'])) {
            $arr['UI'] = $arr['UI']->toArray($canonize);
        }
        if (!is_null($arr['ExpressCheckout'])) {
            $arr['ExpressCheckout'] = $arr['ExpressCheckout']->toArray($canonize);
        }
        if (!is_null($arr['Tokenization'])) {
            $arr['Tokenization'] = $arr['Tokenization']->toArray($canonize);
        }
        return $arr;
    }
}