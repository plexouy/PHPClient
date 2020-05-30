<?php
namespace Plexo\Sdk\Models;

class IntrumentCallback extends ModelsBase
{
    protected $data = [
        'SessionId' => null,
        'Client' => null,
        'Action' => null,
        'PaymentInstrument' => null,
        'OptionalMetadata' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'SessionId' => [
                'type' => 'string',
                'required' => true,
            ],
            'Client' => [
                'type' => 'string',
                'required' => true,
            ],
            'Action' => [
                'type' => 'int',// ActionType
                'required' => true,
            ],
            'PaymentInstrument' => [
                'type' => 'class',
                'class' => 'PaymentInstrument',
                'required' => true,
            ],
            'OptionalMetadata' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

    public function setPaymentInstrument($value)
    {
        if (is_array($value)) {
            $value = PaymentInstrument::fromArray($value);
        }
        if (!($value instanceof PaymentInstrument)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException('PaymentInstrument debe ser del tipo \\Plexo\\Sdk\\Models\\PaymentInstrument o un array compatible.');
        }
        $this->data['PaymentInstrument'] = $value;
        return $this;
    }

    public function toArray($canonize = false)
    {
        return [
            'Action' => $this->data['Action'],
            'Client' => $this->data['Client'],
            'OptionalMetadata' => $this->data['OptionalMetadata'],
            'PaymentInstrument' => $this->data['PaymentInstrument']->toArray($canonize),
            'SessionId' => $this->data['SessionId'],
        ];
    }
}
