<?php
namespace Plexo\Sdk\Models;

class PaymentInstrument extends ModelsBase
{
    /**
     * @var string $InstrumentToken
     * @var string $Name
     * @var IssuerInfo $Issuer
     * @var array<Currency> $SupportedCurrencies
     * @var CardStatus $Status
     * @var long $InstrumentExpirationUTC
     * @var int $AnonInstrumentUsageTimeLimit Optional
     * @var array<AmountLimit> $CreditLimits
     * @var array<TimeLimit> $AdditionalRequirements
     * @var array<FieldType,string> $InstrumentInformation
     * @var string $SessionCreationId
     */

    protected $data = [
        'InstrumentToken' => null,
        'Name' => null,
        'Issuer' => null,
        'SupportedCurrencies' => null,
        'Status' => null,
        'InstrumentExpirationUTC' => null,
        'AnonInstrumentUsageTimeLimit' => null,
        'CreditLimits' => [],
        'AdditionalRequirements' => null,
        'InstrumentInformation' => null,
        'SessionCreationId' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'InstrumentToken' => [
                'type' => 'string',
                'required' => false,
            ],
            'Name' => [
                'type' => 'string',
                'required' => false,
            ],
            'Issuer' => [
                'type' => 'class',
                'class' => 'IssuerInfo',
                'required' => false,
            ],
            'SupportedCurrencies' => [
                'type' => 'class',
                'class' => 'Currency',
                'array' => true,
                'required' => false,
            ],
            'Status' => [
                'type' => 'int',
                'required' => false,
            ],
            'InstrumentExpirationUTC' => [
                'type' => 'long',
                'required' => false,
            ],
            'AnonInstrumentUsageTimeLimit' => [
                'type' => 'int',
                'required' => false,
            ],
            'CreditLimits' => [
                'type' => 'class',
                'class' => 'AmountLimit',
                'array' => true,
                'required' => false,
            ],
            'AdditionalRequirements' => [
                'type' => 'class',
                'class' => 'TimeLimit',
                'array' => true,
                'required' => false,
            ],
            'InstrumentInformation' => [
                'type' => 'array',
                'required' => false,
            ],
            'SessionCreationId' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

    public function setIssuer($value)
    {
        if (is_array($value)) {
            $value = IssuerInfo::fromArray($value);
        }
        if (!($value instanceof IssuerInfo)) {
            throw new \Plexo\Sdk\Exception\InvalidArgumentException('Issuer debe ser del tipo \\Plexo\\Sdk\\Models\\IssuerInfo o un array compatible.');
        }
        $this->data['Issuer'] = $value;
        return $this;
    }

    public function addSupportedCurrency($item)
    {
        array_push($this->data['SupportedCurrencies'], ($item instanceof Currency ? $item : Currency::fromArray($item)));
        return $this;
    }

    public function setSupportedCurrencies(array $value)
    {
        $this->data['SupportedCurrencies'] = [];
        foreach ($value as $item) {
            $this->addSupportedCurrency($item);
        }
        return $this;
    }

    public function addCreditLimit($item)
    {
        array_push($this->data['CreditLimits'], ($item instanceof AmountLimit ? $item : AmountLimit::fromArray($item)));
        return $this;
    }

    public function setCreditLimits(array $value)
    {
        $this->data['CreditLimits'] = [];
        foreach ($value as $item) {
            $this->addCreditLimit($item);
        }
        return $this;
    }

    public function addAdditionalRequirement($item)
    {
        array_push($this->data['AdditionalRequirements'], ($item instanceof TimeLimit ? $item : new TimeLimit($item['SecondsLeft'], $item['RequirementAfterTimeLimit'])));
        return $this;
    }

    public function setAdditionalRequirements(array $value)
    {
        $this->data['AdditionalRequirements'] = [];
        foreach ($value as $item) {
            $this->addAdditionalRequirement($item);
        }
        return $this;
    }

    public function toArray($canonize = false)
    {
        return [
            'AdditionalRequirements' => is_array($this->data['AdditionalRequirements'])
                ? array_map(function ($additionalRequirement) use ($canonize) {
                    return $additionalRequirement->toArray($canonize);
                }, $this->data['AdditionalRequirements'])
                : [],
            'AnonInstrumentUsageTimeLimit' => $this->data['AnonInstrumentUsageTimeLimit'],
            'CreditLimits' => is_array($this->data['CreditLimits'])
                ? array_map(function ($currency) use ($canonize) {
                    return $currency->toArray($canonize);
                }, $this->data['CreditLimits'])
                : [],
            'InstrumentExpirationUTC' => $this->data['InstrumentExpirationUTC'],
            'InstrumentInformation' => $this->data['InstrumentInformation'],
            'InstrumentToken' => $this->data['InstrumentToken'],
            'Issuer' => $this->data['Issuer']->toArray($canonize),
            'Name' => $this->data['Name'],
            'SessionCreationId' => $this->data['SessionCreationId'],
            'Status' => $this->data['Status'],
            'SupportedCurrencies' => is_array($this->data['SupportedCurrencies'])
                ? array_map(function ($currency) use ($canonize) {
                    return $currency->toArray($canonize);
                }, $this->data['SupportedCurrencies'])
                : [],
        ];
    }
}
