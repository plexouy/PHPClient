<?php
namespace Plexo\Sdk\Models;

class Reserve extends Reference
{
    /**
     * @var bool $Commit
     */
    
    protected $data = [
        'Commit' => null,
    ];
    
    public static function getValidationMetadata()
    {
        return [
            'Commit' => [
                'type' => 'bool',
                'required' => false,
            ],
        ];
    }
    
    //    public function toArray($canonize = false)
    //    {
    //        $arr = $canonize
    //            ? [
    //                'Commit' => $this->data['Commit'],
    //            ]
    //            : [
    //                'Commit' => $this->data['Commit'],
    //            ];
    //        return $arr;
    //    }
}
