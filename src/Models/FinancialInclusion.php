<?php
namespace Plexo\Sdk\Models;

class FinancialInclusion extends ModelsBase//implements PlexoModelInterface
{
    /**
     * @var float
     */
    // public $BilledAmount = 0.0;

    /**
     *
     * @var int 
     */
    // public $InvoiceNumber = 0;

    /**
     *
     * @var string 
     */
    // public $InvoiceNumberStr

    /**
     * @var float
     */
    // public $TaxedAmount = 0.0;

    /**
     * @var int One of \Plexo\Sdk\Type\InclusionType
     */
    // public $Type = 0;

    protected $data = [
        'BilledAmount' => 0.0,
        'InvoiceNumber' => 0,
        'InvoiceNumberStr' => null,
        'TaxedAmount' => 0.0,
        'Type' => 0,
    ];

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public static function getValidationMetadata()
    {
        return [
            'BilledAmount' => [
                'type' => 'float',
                'required' => false,
            ],
            'InvoiceNumber' => [
                'type' => 'int',
                'required' => false,
            ],
            'InvoiceNumberStr' => [
                'type' => 'int',
                'required' => false,
            ],
            'TaxedAmount' => [
                'type' => 'float',
                'required' => false,
            ],
            'Type' => [
                'type' => 'int',
                'required' => false,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        if ($canonize) {
            return [
                'BilledAmount'     => is_null($this->BilledAmount)     ? null : sprintf('float(%s)', (float) $this->BilledAmount),
                'InvoiceNumber'    => is_null($this->InvoiceNumber)    ? null : (int) $this->InvoiceNumber,
                'InvoiceNumberStr' => is_null($this->InvoiceNumberStr) ? null : (string) $this->InvoiceNumberStr,
                'TaxedAmount'      => is_null($this->TaxedAmount)      ? null : sprintf('float(%s)', (float) $this->TaxedAmount),
                'Type'             => is_null($this->Type)             ? null : (int) $this->Type,
            ];
        } else {
            return [
                'BilledAmount'     => is_null($this->BilledAmount)     ? null : (float) $this->BilledAmount,
                'InvoiceNumber'    => is_null($this->InvoiceNumber)    ? null : (int) $this->InvoiceNumber,
                'InvoiceNumberStr' => is_null($this->InvoiceNumberStr) ? null : (string) $this->InvoiceNumberStr,
                'TaxedAmount'      => is_null($this->TaxedAmount)      ? null : (float) $this->TaxedAmount,
                'Type'             => is_null($this->Type)             ? null : (int) $this->Type,
            ];
        }
    }
}
