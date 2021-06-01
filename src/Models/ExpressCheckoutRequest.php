<?php
namespace Plexo\Sdk\Models;

class ExpressCheckoutRequest extends ModelsBase
{
    /**
     * @var Authorization $AuthorizationData
     * @var PaymentRequest $PaymentData
     */
    
    protected $data = [
        'AuthorizationData' => null,
        'PaymentData' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'AuthorizationData' => [
                'type' => 'class',
                'class' => 'Authorization',
                'required' => true,
            ],
            'PaymentData' => [
                'type' => 'class',
                'class' => 'PaymentRequest',
                'required' => true,
            ],
        ];
    }
    
    public function setAuthorizationData($value)
    {
        $this->data['AuthorizationData'] = Authorization::fromArray($value);
        return $this;
    }
    
    public function setPaymentData($value)
    {
        $this->data['PaymentData'] = PaymentRequest::fromArray($value);
        return $this;
    }
    
    public function toArray($canonize = false)
    {
        $arr = $this->data;
        
        if (!is_null($arr['AuthorizationData'])) {
            $arr['AuthorizationData'] = $arr['AuthorizationData']->toArray($canonize);
        }
        if (!is_null($arr['PaymentData'])) {
            $arr['PaymentData'] = $arr['PaymentData']->toArray($canonize);
        }
        return $arr;
    }
}