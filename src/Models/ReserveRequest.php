<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Type;

class ReserveRequest extends ModelsBase
{
    /**
     * @var int $ExpirationUTC
     * @var string $ClientReferenceId
     * @var PaymentInstrumentInput $PaymentInstrumentInput
     * @var Item[] $Items
     * @var int $CurrencyId
     * @var int $Installments
     * @var FinancialInclusion $FinancialInclusion
     * @var float $TipAmount (Opcional)
     * @var int $OptionalCommerceId (Opcional)
     * @var string $OptionalMetadata
     */

    protected $data = [
        'ClientReferenceId' => null,
        'CurrencyId' => 0,
        'ExpirationUTC' => 0,
        'FinancialInclusion' => null,
        'Installments' => 0,
        'Items' => null,//[],
        'OptionalCommerceId' => null,
        'OptionalMetadata' => null,
        'PaymentInstrumentInput' => null,
        'TipAmount' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'ClientReferenceId' => [
                'type' => 'string',
                'required' => false,
            ],
            'PaymentInstrumentInput' => [
                'type' => 'class',
                'class' => 'PaymentInstrumentInput',
                'required' => true,
            ],
            'Items' => [
                'type' => 'class',
                'class' => 'Item',
                'array' => true,
                'required' => true,
            ],
            'CurrencyId' => [
                'type' => 'int',
                'required' => true,
            ],
            'ExpirationUTC' => [
                'type' => 'int',
                'required' => true,
            ],
            'Installments' => [
                'type' => 'int',
                'required' => true,
            ],
            'FinancialInclusion' => [
                'type' => 'class',
                'class' => 'FinancialInclusion',
                'required' => false,
            ],
            'TipAmount' => [
                'type' => 'float',
                'required' => false,
            ],
            'OptionalCommerceId' => [
                'type' => 'int',
                'required' => false,
            ],
            'OptionalMetadata' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

    public function addItem($item)
    {
        array_push($this->data['Items'], ($item instanceof Item ? $item : Item::fromArray($item)));
        return $this;
    }

    public function setItems(array $value)
    {
        $this->data['Items'] = [];
        foreach ($value as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    public function setFinancialInclusion($value)
    {
        $this->data['FinancialInclusion'] = ($value instanceof FinancialInclusion ? $value : new FinancialInclusion($value));
        return $this;
    }

    public function setPaymentInstrumentInput($value)
    {
        if (is_array($value)) {
            $value = PaymentInstrumentInput::fromArray($value);
        }
        if (!($value instanceof PaymentInstrumentInput)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException('PaymentInstrumentInput debe ser del tipo \\Plexo\\Sdk\\Models\\PaymentInstrumentInput o un array compatible.');
        }
        $this->data['PaymentInstrumentInput'] = $value;
        return $this;
    }

    public static function fromArray($data)
    {
        $inst = new static();
        foreach ($data as $k => $v) {
            $k = ucfirst($k);
            $setter = 'set'.$k;
            if (method_exists($inst, $setter)) {
                call_user_func([$inst, $setter], $v);
            } else {
                $inst->data[$k] = $v;
            }
        }
        return $inst;
    }

   /* public function toArray($canonize = false)
    {
        $arr = $this->data;
        if ($this->data['Items']) {
            $arr['Items'] = array_map(function ($item) use ($canonize) {
                return ($item instanceof Sdk\Models\Item) ? $item->toArray($canonize) : $item;
            }, $this->data['Items']);
        }
        if ($arr['FinancialInclusion']) {
            $arr['FinancialInclusion'] = $arr['FinancialInclusion']->toArray($canonize);
        }
        if ($arr['PaymentInstrumentInput']) {
            $arr['PaymentInstrumentInput'] = $arr['PaymentInstrumentInput']->toArray($canonize);
        }
        return $arr;
    }*/
    public function toArray($canonize = false)
    {
        $arr = $this->data;
        if (!is_null($arr['FinancialInclusion'])) {
            $arr['FinancialInclusion'] = $arr['FinancialInclusion']->toArray($canonize);
        }
        if (!is_null($arr['PaymentInstrumentInput'])) {
            $arr['PaymentInstrumentInput'] = $arr['PaymentInstrumentInput']->toArray($canonize);
        }
        if ($canonize) {
            if (!is_null($arr['TipAmount'])) {
                $arr['TipAmount'] = sprintf('float(%s)', (float) $arr['TipAmount']);
            }
        }
        if ($this->data['Items']) {
            $arr['Items'] = array_map(function ($item) use ($canonize) {
                return ($item instanceof Item) ? $item->toArray($canonize) : $item;
            }, $this->data['Items']);
        }
        //return array_filter($this->data, function ($v, $k) use ($scheme) {
        //    return ($scheme[$k]['required'] && !is_null($v));
        //}, ARRAY_FILTER_USE_BOTH);
        //        $scheme = self::getValidationMetadata();
        return $arr;
    }
}
