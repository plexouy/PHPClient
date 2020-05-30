<?php
namespace Plexo\Sdk\Models;

class InfoLine extends ModelsBase
{
    /**
     * @var string $Text
     * @var float  $Amount
     */
    protected $data = [
        'Text' => null,
        'Amount' => null,
    ];

    /**
     * 
     * @param array $params
     */
    public function __construct($text = null, $amount = null) {
        $this->data['Text'] = $text;
        $this->data['Amount'] = $amount;
    }

    public static function getValidationMetadata()
    {
        return [
            'Text' => [
                'type' => 'string',
                'required' => true,
            ],
            'Amount' => [
                'type' => 'float',
                'required' => true,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        return [
            'Amount' => $canonize ? sprintf('float(%s)', (float) $this->data['Amount']) : (float) $this->data['Amount'],
            'Text'   => $this->data['Text'],
        ];
    }
}
