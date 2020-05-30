<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk;

class ReserveRequest extends ModelsBase
{
    /**
     * @var int $ExpirationUTC
     * @var string $ClientReferenceId
     * @var PaymentInstrumentInput $PaymentInstrumentInput
     * @var array(Item) $Items
     * @var int $CurrencyId
     * @var int $Installments
     * @var FinancialInclusion $FinancialInclusion
     * @var decimal $TipAmount (Opcional)
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
        $this->data['PaymentInstrumentInput'] = ($value instanceof PaymentInstrumentInput ? $value : new PaymentInstrumentInput($value));
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

    public function toArray($canonize = false)
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
    }
}
