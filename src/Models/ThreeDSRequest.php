<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Type;

class ThreeDSRequest extends ModelsBase
{
    /**
     * @var string $ClientReferenceId
     * @var string $InstrumentToken
     * @var int $CommerceId
     * @var string $Indicator 
     * @var float $Amount = 0.0;
     * @var int $CurrencyId
     * @var string $RedirectUrl
     * @var string $CallbackUrl
     */

    protected $data = [
        'ClientReferenceId' => null,
        'InstrumentToken' => null,
        'CommerceId' => 0,
        'Indicator' => null,
        'Amount' => 0.0,
        'CurrencyId' => 0,
        'RedirectUrl' => null,
        'CallbackUrl' => null,
    ];

//    public static function loadValidatorMetadata(\Symfony\Component\Validator\Mapping\ClassMetadata $metadata)
//    {
//
//    }

    public static function getValidationMetadata()
    {
        return [
            'ClientReferenceId' => [
                'type' => 'string',
                'required' => true,
            ],
            'InstrumentToken' => [
                'type' => 'string',
                'required' => true,
            ],
            'CommerceId' => [
                'type' => 'int',
                'required' => true,
            ],
            'Indicator' => [
                'type' => 'string',
                'required' => true,
            ],
            'Amount' => [
                'type' => 'float',
                'required' => false,
            ],
            'CurrencyId' => [
                'type' => 'int',
                'required' => true,
            ],
            'RedirectUrl' => [
                'type' => 'string',
                'required' => true,
            ],
            'CallbackUrl' => [
                'type' => 'string',
                'CallbackUrl' => false,
            ],
        ];
    }



    public static function fromArray(array $data)
    {
        $inst = new self();
        foreach ($data as $k => $v) {
            $k = ucfirst($k);
            $setter = 'set'.$k;
            if (method_exists($inst, $setter)) {
                call_user_func([$inst, $setter], $v);
            } else {
                $inst->__set($k, $v);
//                $inst->data[$k] = $v;
            }
        }
        return $inst;
    }

    public function toArray($canonize = false)
    {
        $arr = $this->data;
        if ($canonize) {
            if (!is_null($arr['Amount'])) {
                $arr['Amount'] = sprintf('float(%s)', (float) $arr['Amount']);
            }
        }
        return $arr;
    }
}
