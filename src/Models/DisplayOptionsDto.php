<?php
namespace Plexo\Sdk\Models;

class DisplayOptionsDto extends ModelsBase
{
    /**
     * @var bool $Accessibility Default false
     * @var bool $Details Default false
     * @var bool $Footer Default false
     * @var bool $Logo Default false
     * @var bool $Titles Default false*
     */
    
    protected $data = [
        'Accessibility' => null,
        'Details' => null,
        'Footer' => null,
        'Logo' => null,
        'Titles' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'Accessibility' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Details' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Footer' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Logo' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Titles' => [
                'type' => 'bool',
                'required' => false,
            ],
        ];
    }
    
    public function toArray($canonize = false)
    {
        return [
            'Accessibility' => $this->data['Accessibility'],
            'Details' => $this->data['Details'],
            'Footer' => $this->data['Footer'],
            'Logo' => $this->data['Logo'],
            'Titles' => $this->data['Titles'],
        ];
    }
}