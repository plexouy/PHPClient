<?php
namespace Plexo\Sdk\Models;

class UIOptionsDto extends ModelsBase
{
    /**
     * @var bool $AutoDarkTheme  Default false
     * @var Dictionary<string, string> $Colors (Optional)
     * @var string $LogoURL
     * @var string $Theme
     */
    
    protected $data = [
        
        'AutoDarkTheme' => false,
        'Colors' => null,
        'LogoURL' => null,
        'Theme' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'AutoDarkTheme' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Colors' => [
                'type' => 'array',
                'required' => false,
            ],
            'LogoURL' => [
                'type' => 'string',
                'required' => false,
            ],
            'Theme' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }
}