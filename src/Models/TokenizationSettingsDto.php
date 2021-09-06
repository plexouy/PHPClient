<?php
namespace Plexo\Sdk\Models;

class TokenizationSettingsDto extends ModelsBase
{
    /**
     * @var DisplayOptionsDto $Display
     */
    
    protected $data = [
        'Display' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'Display' => [
                'type' => 'class',
                'class' => 'DisplayOptionsDto',
                'required' => false,
            ],
        ];
    }
    public function setDisplay($value)
    {
        $this->data['Display'] = DisplayOptionsDto::fromArray($value);
        return $this;
    }
    public function toArray($canonize = false)
    {
        $arr = $this->data;
        if (!is_null($arr['Display'])) {
            $arr['Display'] = $arr['Display']->toArray($canonize);
        }
        return $arr;
    }
}