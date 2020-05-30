<?php
namespace Plexo\Sdk\Models;

class RefundRequest extends ModelsBase
{
    /**
     * @var float $Amount
     * @var string $ClientReferenceId
     * @var string $MetaReference
     * @var ReferenceType $Type
     */
    protected $data = [
        'Amount' => null,
        'ClientReferenceId' => null,
        'MetaReference' => null,
        'Type' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'Amount' => [
                'type' => 'float',
                'required' => true,
            ],
            'ClientReferenceId' => [
                'type' => 'string',
                'required' => true,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
            'Type' => [
                'type' => 'int',
                'required' => true,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        return [
            'Amount' => $canonize ? sprintf('float(%s)', (float) $this->data['Amount']) : (float) $this->data['Amount'],
            'ClientReferenceId' => $this->data['ClientReferenceId'],
            'MetaReference' => $this->data['MetaReference'],
            'Type' => $this->data['Type'],
        ];
    }
}
