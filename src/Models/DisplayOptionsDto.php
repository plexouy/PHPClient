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
        'Accessibility' => false,
        'Details' => false,
        'Footer' => false,
        'Logo' => false,
        'Titles' => false,
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
}